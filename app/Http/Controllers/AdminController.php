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

    /** ---------------- Users ---------------- */
    public function users()
    {
        $users = User::where('level', 'warga')
            ->select('id', 'name', 'email', 'nohp', 'address', 'level as role')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.user', compact('users'));
    }

    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent admin from deleting themselves
            if ($user->id == Auth::id()) {
                return redirect()->route('admin.user')->with('error', 'Tidak dapat menghapus akun sendiri.');
            }

            $user->delete();

            return redirect()->route('admin.user')->with('success', 'Data warga berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Gagal menghapus data warga: ' . $e->getMessage());
        }
    }

    public function editUser($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ID tidak valid');
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ID tidak valid');
        }

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $id,
            'nohp'    => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'nohp'    => $request->nohp,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.user')->with('success', 'Data warga berhasil diperbarui');
    }

    /** ---------------- Dues ---------------- */
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

    /** ---------------- Officers ---------------- */
    public function officers()
    {
        $officers = Officer::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::where('level', 'warga')
            ->select('id', 'name', 'email', 'nohp', 'address')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.officers.officers', compact('officers', 'users'));
    }

    public function addOfficer()
    {
        return view('admin.officers.add');
    }

    public function storeOfficer(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'nohp'     => 'required|string|max:15',
            'address'  => 'required|string|max:255',
            'position' => 'required|string',
        ]);

        // Simpan ke users
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nohp'     => $request->nohp,
            'address'  => $request->address,
        ]);

        // Simpan ke officers
        Officer::create([
            'iduser'   => $user->id,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.officers')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function destroyOfficer($id)
    {
        try {
            $officer = Officer::findOrFail($id);
            $user    = $officer->user;

            // Prevent officer from deleting themselves
            if ($user && $user->id == Auth::id()) {
                return redirect()->route('admin.officers')->with('error', 'Tidak dapat menghapus akun sendiri.');
            }

            $officer->delete();
            if ($user) $user->delete();

            return redirect()->route('admin.officers')->with('success', 'Data officer berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.officers')->with('error', 'Gagal menghapus data officer: ' . $e->getMessage());
        }
    }

    /** ---------------- Members ---------------- */
    public function members()
    {
        $members = DuesMember::with(['user', 'duesCategory'])
            ->select('dues_members.id', 'dues_members.iduser', 'dues_members.idduescategory')
            ->orderBy('dues_members.created_at', 'desc')
            ->get();

        return view('admin.members', compact('members'));
    }

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

        public function destroyCategory($id)
{
    try {
        $category = DuesCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('categories.index')->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
    }
}
}
