<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Officer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminOfficerController extends Controller
{
    /**
     * Display all officers
     */
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

    /**
     * Show add officer form
     */
    public function addOfficer()
    {
        return view('admin.officers.add');
    }

    /**
     * Store new officer
     */
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

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'nohp'     => $request->nohp,
            'address'  => $request->address,
            'level'    => 'warga',
        ]);

        // Create officer record
        Officer::create([
            'iduser'   => $user->id,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.officers')->with('success', 'Petugas berhasil ditambahkan');
    }

    /**
     * Delete officer
     */
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
}
