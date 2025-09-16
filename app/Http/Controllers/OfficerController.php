<?php

namespace App\Http\Controllers;

use App\Models\DuesMember;
use App\Models\Payment;
use App\Models\User;
use App\Models\DuesCategory;
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

        $categories = DuesCategory::all();

        return view('officer.dashboard', compact(
            'pendingPayments',
            'recentPayments',
            'totalPending',
            'totalApproved',
            'totalRejected',
            'categories'
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

    // New method to list members for officer
    public function members(Request $request)
    {
        $query = \App\Models\DuesMember::with(['user', 'duesCategory', 'payments', 'officer']);

        // Search by member name or email
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }

        // Filter by month and year
        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('created_at', $request->month);
        }
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('created_at', $request->year);
        }

        $members = $query->orderBy('created_at', 'desc')->paginate(10);

        // Summary statistics
        $totalMembers = $query->count();
        $totalPaid = $query->where('status', 'lunas')->count();
        $totalUnpaid = $query->where('status', 'belum_bayar')->count();

        $categories = DuesCategory::all();

        return view('officer.members', compact('members', 'totalMembers', 'totalPaid', 'totalUnpaid', 'categories'));
    }

    // New method to show payments for a member for officer
    public function payments($id)
    {
        try {
            $member = \App\Models\DuesMember::with(['user', 'duesCategory'])->findOrFail($id);
            $payments = \App\Models\Payment::with(['user', 'duesCategory', 'officer'])
                ->where('iduser', $member->iduser)
                ->where('idduescategory', $member->idduescategory)
                ->orderBy('created_at', 'desc')
                ->get();

            $categories = DuesCategory::all();

            return view('officer.members.payments', compact('member', 'payments', 'categories'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('officer.members')
                ->with('error', 'Data anggota tidak ditemukan!');
        }
    }

    // New method to show all payments for officer
    public function allPayments(Request $request)
    {
        $query = Payment::with(['user', 'duesCategory', 'officer']);

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method != '') {
            $query->where('payment_method', $request->payment_method);
        }

        // Search by user name or payment amount
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%$search%");
                })->orWhere('nominal', 'like', "%$search%");
            });
        }

        $payments = $query->orderBy('created_at', 'desc')->paginate(15);

        $categories = DuesCategory::all();

        return view('officer.payments.index', compact('payments', 'categories'));
    }

    // New method to show categories for officer
    public function categories()
    {
        $categories = DuesCategory::with('officer.user')->get();
        return view('officer.categories.index', compact('categories'));
    }
}

