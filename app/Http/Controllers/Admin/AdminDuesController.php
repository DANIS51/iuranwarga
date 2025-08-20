<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DuesMember;
use Illuminate\Support\Facades\DB;

class AdminDuesController extends Controller
{
    /**
     * Display all dues
     */
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

    /**
     * Display reports page
     */
    public function reports()
    {
        return view('admin.reports');
    }

    /**
     * Display settings page
     */
    public function settings()
    {
        return view('admin.settings');
    }
}
