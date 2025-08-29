<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DuesMember;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalUsers       = User::count();
        $totalDues        = DuesMember::count();
        $totalPayments    = Payment::count();
        $totalAmount      = Payment::sum('nominal');
        $pendingApprovals = Payment::where('status', 'pending')->count();

        $recentTransactions = Payment::select(
                'create_payment_tables.*',
                'users.name as user_name',
                'dues_categories.period as dues_category'
            )
            ->join('users', 'create_payment_tables.iduser', '=', 'users.id')
            ->join('dues_categories', 'create_payment_tables.idduescategory', '=', 'dues_categories.id')
            ->orderBy('create_payment_tables.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDues',
            'totalPayments',
            'totalAmount',
            'recentTransactions',
            'pendingApprovals'
        ));
    }

    /**
     * Get dashboard data for API
     */
    public function getDashboardData()
    {
        $totalUsers       = User::count();
        $totalDues        = DuesMember::count();
        $totalPayments    = Payment::count();
        $totalAmount      = Payment::sum('nominal');
        $pendingApprovals = Payment::where('status', 'pending')->count();

        $recentTransactions = Payment::select(
                'create_payment_tables.*',
                'users.name as user_name',
                'dues_categories.period as dues_category'
            )
            ->join('users', 'create_payment_tables.iduser', '=', 'users.id')
            ->join('dues_categories', 'create_payment_tables.idduescategory', '=', 'dues_categories.id')
            ->orderBy('create_payment_tables.created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'total_users'         => $totalUsers,
            'total_dues'          => $totalDues,
            'total_payments'      => $totalPayments,
            'total_amount'        => $totalAmount,
            'pending_approvals'   => $pendingApprovals,
            'recent_transactions' => $recentTransactions
        ]);
    }
}
