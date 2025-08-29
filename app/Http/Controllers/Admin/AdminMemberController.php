<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DuesMember;
use App\Models\User;
use App\Models\DuesCategory;

class AdminMemberController extends Controller
{
    /**
     * Display all members
     */
    public function members()
    {
        $members = DuesMember::with(['user', 'duesCategory'])
            ->select('dues_members.id', 'dues_members.iduser', 'dues_members.idduescategory')
            ->orderBy('dues_members.created_at', 'desc')
            ->get();

        return view('admin.members', compact('members'));
    }

    /**
     * Show the form for creating a new member
     */
    public function create()
    {
        $users = User::where('level', 'warga')->get();
        $duesCategories = DuesCategory::all();
        
        return view('admin.members.add', compact('users', 'duesCategories'));
    }

    /**
     * Store a newly created member
     */
    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:users,id',
            'idduescategory' => 'required|exists:dues_categories,id',
        ]);

        // Check if member already exists
        $existingMember = DuesMember::where('iduser', $request->iduser)
            ->where('idduescategory', $request->idduescategory)
            ->first();

        if ($existingMember) {
            return redirect()->back()
                ->with('error', 'Anggota sudah terdaftar untuk kategori iuran ini!')
                ->withInput();
        }

        DuesMember::create([
            'iduser' => $request->iduser,
            'idduescategory' => $request->idduescategory,
        ]);

        return redirect()->route('admin.members')
            ->with('success', 'Anggota iuran berhasil ditambahkan!');
    }

    /**
     * Display payments for a specific member
     */
    public function payments($id)
    {
        $member = DuesMember::with(['user', 'duesCategory'])->findOrFail($id);
        $payments = \App\Models\Payment::with(['user', 'duesCategory', 'officer'])
            ->where('idmember', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.members.payments', compact('member', 'payments'));
    }
}
