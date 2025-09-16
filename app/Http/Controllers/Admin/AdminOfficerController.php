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
            ->select('id', 'name', 'username', 'email', 'nohp', 'address')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.officers.officers', compact('officers', 'users'));
    }

    /**
     * Show add officer form
     */
    public function addOfficer()
    {
        $data['user'] = User::all();
        return view('admin.officers.add', $data);
    }

    /**
     * Store new officer
     */
    public function storeOfficer(Request $request)
    {
        // $request->validate([
        //     'username' => 'required|string|unique:users,username',
        //     'name'     => 'required|string|max:255',
        //     'email'    => 'required|email|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'nohp'     => 'required|string|max:15',
        //     'address'  => 'required|string|max:255',
        //     'position' => 'required|string',
        // ]);

        $validasi = $request->validate([
            'id_user' => 'required'
        ]);

        $id = $request['id_user'];

        $user = User::findOrFail($id);

        // Check if user is already an officer
        if ($user->level === 'officer') {
            return redirect()->route('admin.officers')->with('error', 'User sudah menjadi officer.');
        }

        $user->update([
            'level' => 'officer'
        ]);

        // Check if officer record already exists
        if (!Officer::where('iduser', $id)->exists()) {
            Officer::create([
                'iduser'   => $id,
                'position' => 'Officer',
            ]);
        }

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
