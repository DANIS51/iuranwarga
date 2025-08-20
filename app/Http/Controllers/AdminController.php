<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DuesMember;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Controller ini sekarang hanya untuk fitur yang belum dipisahkan
    // seperti categories management
    
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
    
    public function categories()
    {
        // Method ini masih digunakan untuk categories
        return view('admin.categories');
    }
}
