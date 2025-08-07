<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DuesCategory;
use App\Models\DuesMember;
use App\Models\Payment;
use App\Models\Officer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data langsung dari database
        $totalUsers = User::count();
        $totalDues = DuesMember::count();
        $totalPayments = Payment::count();
        $totalAmount = Payment::sum('nominal');
        $pendingApprovals = Payment::where('status', 'pending')->count();

        // Ambil transaksi terbaru
        $recentTransactions = Payment::select(
            'create_payment_tables.*',
            'users.name as user_name',
            'dues_categories.period as dues_category'
        )
        ->join('users', 'create_payment_tables.iduser', '=', 'users.id')
        ->join('dues_categories', 'create_payment_tables.period', '=', 'dues_categories.period')
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

    public function users()
    {
        $users = User::where('level', 'warga')
            ->select('id', 'name', 'email','nohp','address', 'level as role')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.user', compact('users'));
    }

    public function dues()
    {
        $dues = DuesMember::select(
            'dues_members.id',
            'users.name as user_name',
            'dues_categories.period as category',
            'dues_categories.nominal as amount',
            DB::raw('CASE WHEN payments.id IS NOT NULL THEN "Lunas" ELSE "Pending" END as status')
        )
        ->join('users', 'dues_members.iduser', '=', 'users.id')
        ->join('dues_categories', 'dues_members.idduescategory', '=', 'dues_categories.id')
        ->leftJoin('create_payment_tables as payments', function ($join) {
            $join->on('dues_members.iduser', '=', 'payments.iduser')
                ->on('dues_categories.period', '=', 'payments.period');
        })
        ->orderBy('dues_members.created_at', 'desc')
        ->get();

        return view('admin.dues', compact('dues'));
    }

    public function payments()
    {
        $payments = Payment::select(
            'create_payment_tables.*',
            'users.name as user_name',
            'dues_categories.period as category'
        )
        ->join('users', 'create_payment_tables.iduser', '=', 'users.id')
        ->join('dues_categories', 'create_payment_tables.period', '=', 'dues_categories.period')
        ->orderBy('create_payment_tables.created_at', 'desc')
        ->get();

        return view('admin.payments', compact('payments'));
    }

    public function reports()
    {
        $monthlyIncome = Payment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(nominal) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy('month')
        ->get();

        $categoryStats = Payment::select(
            'dues_categories.period as category',
            DB::raw('SUM(create_payment_tables.nominal) as total')
        )
        ->join('dues_categories', 'create_payment_tables.period', '=', 'dues_categories.period')
        ->whereYear('create_payment_tables.created_at', date('Y'))
        ->groupBy('dues_categories.period')
        ->get();

        return view('admin.reports', compact('monthlyIncome', 'categoryStats'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent admin from deleting themselves
            if ($user->id == auth()->id) {
                return redirect()->route('admin.user')->with('error', 'Tidak dapat menghapus akun sendiri.');
            }

            $user->delete();

            return redirect()->route('admin.user')->with('success', 'Data warga berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Gagal menghapus data warga: ' . $e->getMessage());
        }
    }

    public function getDashboardData()
    {
        $totalUsers = User::count();
        $totalDues = DuesMember::count();
        $totalPayments = Payment::count();
        $totalAmount = Payment::sum('nominal');
        $pendingApprovals = Payment::where('status', 'pending')->count();

        $recentTransactions = Payment::select(
            'create_payment_tables.*',
            'users.name as user_name',
            'dues_categories.period as dues_category'
        )
        ->join('users', 'create_payment_tables.iduser', '=', 'users.id')
        ->join('dues_categories', 'create_payment_tables.period', '=', 'dues_categories.period')
        ->orderBy('create_payment_tables.created_at', 'desc')
        ->limit(5)
        ->get();

        return response()->json([
            'total_users' => $totalUsers,
            'total_dues' => $totalDues,
            'total_payments' => $totalPayments,
            'total_amount' => $totalAmount,
            'pending_approvals' => $pendingApprovals,
            'recent_transactions' => $recentTransactions
        ]);
    }

    public function officers()
    {
        $officers = Officer::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.officers.officers', compact('officers'));
    }

    public function addOfficer()
    {
        return view('admin.officers.add');
    }

    public function storeOfficer(Request $request)
{
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'nohp' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'position' => 'required|string',
    ]);

    // Proses simpan data ke tabel users dan officers
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'nohp' => $request->nohp,
        'address' => $request->address,
    ]);

    Officer::create([
        'iduser' => $user->id,
        'position' => $request->position,
    ]);

    return redirect()->route('admin.officers')->with('success', 'Petugas berhasil ditambahkan');
}
}
