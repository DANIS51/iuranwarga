<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DuesMember;

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
}
