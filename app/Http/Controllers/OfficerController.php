<?php

namespace App\Http\Controllers;

use App\Models\DuesMember;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    public function dashboard()
    {
        // Get officer-specific data
        $officerId = auth()->id();

        // Get payments that need officer approval
        $pendingPayments = Payment::where('status', 'pending')
            ->with(['user', 'duesCategory'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get recent payments handled by officer
        $recentPayments = Payment::where('petugas', $officerId)
            ->with(['user', 'duesCategory'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        // Get payment statistics
        $totalPending = Payment::where('status', 'pending')->count();
        $totalApproved = Payment::where('status', 'approved')->count();
        $totalRejected = Payment::where('status', 'rejected')->count();

        return view('officer.dashboard', compact(
            'pendingPayments',
            'recentPayments',
            'totalPending',
            'totalApproved',
            'totalRejected'
        ));
    }

    public function approvePayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'approved',
            'petugas' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil disetujui');
    }

    public function rejectPayment($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => 'rejected',
            'petugas' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak');
    }
}
