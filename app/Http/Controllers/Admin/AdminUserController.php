<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display all users
     */
    public function users()
    {
        $users = User::where('level', 'warga')
            ->select('id', 'name', 'email', 'nohp', 'address', 'level as role')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.user', compact('users'));
    }

    /**
     * Show edit user form
     */
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

    /**
     * Update user data
     */
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

    /**
     * Delete user
     */
    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->id == Auth::id()) {
                return redirect()->route('admin.user')->with('error', 'Tidak dapat menghapus akun sendiri.');
            }

            $user->delete();

            return redirect()->route('admin.user')->with('success', 'Data warga berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Gagal menghapus data warga: ' . $e->getMessage());
        }
    }
}
