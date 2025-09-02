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
        $payments = Payment::with(['user', 'member', 'duesCategory', 'officer'])
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

        return view('admin.payments.create', compact('users', 'members', 'categories', 'officers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:users,id',
            'idmember' => 'required|exists:dues_members,id',
            'idduescategory' => 'required|exists:dues_categories,id',
            'nominal' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['petugas'] = auth()->user()->id;
        $data['status'] = 'completed';

        // Handle file upload
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('payment_proofs', $filename, 'public');
            $data['bukti_pembayaran'] = $path;
        }

        Payment::create($data);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function show($id)
    {
        $payment = Payment::with(['user', 'member', 'duesCategory', 'officer'])->findOrFail($id);
        return view('admin.payments.lihat', compact('payment'));
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
