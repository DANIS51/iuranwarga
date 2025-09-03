<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\DuesMember;
use App\Models\DuesCategory;
use App\Models\Officer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'member.user', 'member.duesCategory', 'duesCategory', 'officer.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $users = User::where('level', 'warga')->get();
        $members = DuesMember::with(['user', 'duesCategory'])->get();
        $categories = DuesCategory::all();
        $officers = Officer::with('user')->get();

        // Check if member is fully paid if member id is passed as query param
        $memberId = request()->query('member');
        if ($memberId) {
            $member = DuesMember::with(['duesCategory', 'user'])->find($memberId);
            if ($member) {
                $totalPaid = $member->total_payments;
                $expectedAmount = $member->duesCategory ? $member->duesCategory->nominal : 0;
                if ($totalPaid >= $expectedAmount) {
                    return redirect()->route('admin.members')->with('error', 'Pembayaran sudah lunas, tidak bisa menambah pembayaran lagi.');
                }
            }
        }

        return view('admin.payments.create', compact('users', 'members', 'categories', 'officers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:users,id',
            'idduescategory' => 'required|exists:dues_categories,id',
            'nominal' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::transaction(function() use ($request) {
            $category = DuesCategory::findOrFail($request->idduescategory);
            $nominal_per_bulan = $category->nominal;
            $months_paid = floor($request->nominal / $nominal_per_bulan);

            // Get officer id from logged in user
            $officer = Officer::where('iduser', auth()->id())->first();
            $officerId = $officer ? $officer->id : null;

            // If no officer found, set petugas to 0 or null to avoid DB error
            if (is_null($officerId)) {
                $officerId = 0; // or null if DB allows
            }

            // Simpan payment dulu
            $payment = Payment::create([
                'iduser' => $request->iduser,
                'idduescategory' => $request->idduescategory,
                'nominal' => $request->nominal,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'status' => 'completed',
                'notes' => $request->notes,
                'petugas' => $officerId,
            ]);

            // Create dues_members records for the months being paid
            $currentMonth = now()->format('Y-m');
            for ($i = 0; $i < $months_paid; $i++) {
                $month = date('Y-m', strtotime($currentMonth . ' +' . $i . ' month'));
                DuesMember::firstOrCreate(
                    [
                        'iduser' => $request->iduser,
                        'idduescategory' => $request->idduescategory,
                        'bulan' => $month,
                    ],
                    [
                        'status' => 'belum_bayar',
                    ]
                );
            }

            // Update the status of the dues_members records to 'lunas'
            $dues = DuesMember::where('iduser', $request->iduser)
                ->where('idduescategory', $request->idduescategory)
                ->where('status', 'belum_bayar')
                ->orderBy('bulan', 'asc')
                ->limit($months_paid)
                ->get();

            foreach ($dues as $d) {
                $d->update([
                    'status' => 'lunas',
                    'tanggal_bayar' => $request->payment_date,
                    'idpayment' => $payment->id,
                ]);
            }

            // Set idmember to the first dues_member updated
            if ($dues->isNotEmpty()) {
                $payment->update(['idmember' => $dues->first()->id]);
            }
        });

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil ditambahkan & cicilan terupdate');
    }


    public function show($id)
    {
        $payment = Payment::with(['user', 'duesCategory', 'officer'])->findOrFail($id);

        // hitung jumlah bulan yang terbayar
        $perBulan = $payment->duesCategory ? $payment->duesCategory->nominal : 0;
        $jumlahBulan = $perBulan > 0 ? intval($payment->nominal / $perBulan) : 0;

        return view('admin.payments.lihat', compact('payment', 'jumlahBulan'));
    }



    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $users = User::where('level', 'warga')->get();
        $members = DuesMember::with(['user', 'duesCategory'])->get();
        $categories = DuesCategory::all();
        $officers = Officer::with('user')->get();

        return view('admin.payments.edit', compact('payment', 'users', 'members', 'categories', 'officers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
    'iduser' => 'required|exists:users,id',
    'idduescategory' => 'required|exists:dues_categories,id',
    'nominal' => 'required|numeric|min:0',
    'payment_method' => 'required|in:cash,transfer,qris',
    'payment_date' => 'required|date',
    'status' => 'required|in:pending,completed,cancelled',
    'notes' => 'nullable|string|max:500',
    'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $payment = Payment::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('bukti_pembayaran')) {
        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }
        $file = $request->file('bukti_pembayaran');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('payment_proofs', $filename, 'public');
        $data['bukti_pembayaran'] = $path;
    }

    $payment->update($data);

    return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diperbarui');

    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        // Delete file if exists
        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil dihapus');
    }

    public function userHistory($userId)
    {
        $payments = Payment::with(['member', 'duesCategory'])
            ->where('iduser', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('payments.history', compact('payments'));
    }

    // Method API dihapus sesuai permintaan
}
