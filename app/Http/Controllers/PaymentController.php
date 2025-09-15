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

        $selectedUser = null;
        $selectedCategory = null;
        $selectedMember = null;

        $memberId = request()->query('member');
        if ($memberId) {
            $member = DuesMember::with(['duesCategory', 'user'])->find($memberId);
            if ($member) {
                $selectedUser = $member->iduser;
                $selectedCategory = $member->idduescategory;
                $selectedMember = $member->id;

                $totalPaid = $member->total_payments;
                $expectedAmount = $member->duesCategory ? $member->duesCategory->nominal : 0;
                if ($totalPaid >= $expectedAmount) {
                    return redirect()->route('admin.members')->with('error', 'Pembayaran sudah lunas, tidak bisa menambah pembayaran lagi.');
                }
            }
        }

        return view('admin.payments.create', compact('users', 'members', 'categories', 'officers', 'selectedUser', 'selectedCategory', 'selectedMember'));
    }

    public function createForOfficer()
    {
        $users = User::where('level', 'warga')->get();
        $members = DuesMember::with(['user', 'duesCategory'])->get();
        $categories = DuesCategory::all();
        $officers = Officer::with('user')->get();

        $selectedUser = null;
        $selectedCategory = null;
        $selectedMember = null;

        return view('officer.payments.create', compact('users', 'members', 'categories', 'officers', 'selectedUser', 'selectedCategory', 'selectedMember'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:users,id',
            'idmember' => 'nullable|exists:dues_members,id',
            'idduescategory' => 'required|exists:dues_categories,id',
            'nominal' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_date' => 'required|date',
            'period' => 'required|in:mingguan,bulanan,tahunan',
            'notes' => 'nullable|string|max:500',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Check if the dues member is already fully paid
        if ($request->idmember) {
            $duesMember = DuesMember::find($request->idmember);
            if ($duesMember && $duesMember->status === DuesMember::STATUS_LUNAS) {
                return redirect()->back()->with('error', 'Pembayaran sudah lunas, tidak bisa menambah pembayaran lagi.');
            }
        }

        DB::transaction(function () use ($request) {
            $category = DuesCategory::findOrFail($request->idduescategory);
            $nominal_per_bulan = $category->nominal;
            $months_paid = floor($request->nominal / $nominal_per_bulan);

            $officer = Officer::where('iduser', auth()->id())->first();
            $officerName = $officer ? $officer->user->name : 'Unknown';

            $currentMonth = date('Y-m', strtotime($request->payment_date));

            // Always find or create a dues_member for the current month to link the payment
            $duesMember = DuesMember::firstOrCreate(
                [
                    'iduser' => $request->iduser,
                    'idduescategory' => $request->idduescategory,
                    'bulan' => $currentMonth,
                ],
                [
                    'status' => DuesMember::STATUS_BELUM_BAYAR,
                ]
            );

            $paymentData = [
                'iduser' => $request->iduser,
                'idmember' => $duesMember->id,
                'idduescategory' => $request->idduescategory,
                'nominal' => $request->nominal,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'period' => $request->period,
                'status' => 'completed',
                'notes' => $request->notes,
                'petugas' => $officerName,
            ];

            // Upload bukti pembayaran jika ada
            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payment_proofs', $filename, 'public');
                $paymentData['bukti_pembayaran'] = $path;
            }

            $payment = Payment::create($paymentData);

            $paidMonths = [];
            for ($i = 0; $i < $months_paid; $i++) {
                $month = date('Y-m', strtotime("$currentMonth +$i month"));
                $paidMonths[] = $month;

                DuesMember::firstOrCreate(
                    [
                        'iduser' => $request->iduser,
                        'idduescategory' => $request->idduescategory,
                        'bulan' => $month,
                    ],
                    [
                        'status' => DuesMember::STATUS_BELUM_BAYAR,
                    ]
                );
            }

            if (!empty($paidMonths)) {
                DuesMember::where('iduser', $request->iduser)
                    ->where('idduescategory', $request->idduescategory)
                    ->whereIn('bulan', $paidMonths)
                    ->update([
                        'status' => DuesMember::STATUS_LUNAS,
                        'tanggal_bayar' => $request->payment_date,
                        'idpayment' => $payment->id,
                    ]);
            }

            // Update the dues_member status based on total payments
            $totalPaid = $duesMember->payments()->where('status', 'completed')->sum('nominal');
            $expectedAmount = $category->nominal;

            if ($totalPaid >= $expectedAmount) {
                $duesMember->status = DuesMember::STATUS_LUNAS;
            } elseif ($totalPaid > 0) {
                $duesMember->status = DuesMember::STATUS_BELUM_LUNAS;
            } else {
                $duesMember->status = DuesMember::STATUS_BELUM_BAYAR;
            }

            $duesMember->save();
        });

        $redirectRoute = auth()->user()->level === 'admin' ? 'admin.payments.index' : 'officer.dashboard';

        return redirect()->route($redirectRoute)
            ->with('success', 'Pembayaran berhasil ditambahkan & cicilan terupdate');
    }

    public function show($id)
    {
        $payment = Payment::with(['user', 'duesCategory', 'officer'])->findOrFail($id);
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
            'idmember' => 'nullable|exists:dues_members,id',
            'idduescategory' => 'required|exists:dues_categories,id',
            'nominal' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_date' => 'required|date',
            'period' => 'required|in:mingguan,bulanan,tahunan',
            'status' => 'required|in:pending,completed,cancelled',
            'notes' => 'nullable|string|max:500',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $payment = Payment::findOrFail($id);
        $data = $request->all();

        $officer = Officer::where('iduser', auth()->id())->first();
        $officerName = $officer ? $officer->user->name : 'Unknown';
        $data['petugas'] = $officerName;

        if ($request->hasFile('bukti_pembayaran')) {
            if ($payment->bukti_pembayaran) {
                Storage::disk('public')->delete($payment->bukti_pembayaran);
            }
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('payment_proofs', $filename, 'public');
            $data['bukti_pembayaran'] = $path;
        }

        $payment->update($data);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

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
}
