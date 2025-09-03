<?php

namespace App\Http\Controllers;

use App\Models\DuesMember;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        // Get user's dues members
        $duesMembers = DuesMember::where('iduser', $userId)
            ->with(['duesCategory'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get user's payments
        $payments = Payment::where('iduser', $userId)
            ->with(['duesCategory'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate totals
        $totalPaid = $payments->where('status', 'approved')->sum('nominal');
        $totalPending = $payments->where('status', 'pending')->sum('nominal');
        $totalDues = $duesMembers->sum(function($duesMember) {
            return $duesMember->duesCategory->nominal ?? 0;
        });

        return view('officers.dashboard', compact(
            'duesMembers',
            'payments',
            'totalPaid',
            'totalPending',
            'totalDues'
        ));
    }
}
