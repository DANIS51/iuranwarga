<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DuesCategory;
use App\Models\DuesMember;
use App\Models\Payment;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerAdmin extends Controller
{
    public function index()
    {
        $data['total_users'] = User::count();
        $data['total_dues'] = DuesMember::count();
        $data['total_payments'] = Payment::count();
        $data['total_amount'] = Payment::sum('nominal');
        $data['recent_payments'] = Payment::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', $data);
    }

    public function users()
    {
        $data['users'] = User::orderBy('created_at', 'desc')->get();
        return view('admin.user', $data);
    }

    // public function dues()
    // {
    //     $data['dues'] = DuesMember::with(['user', 'duesCategory'])
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //     return view('admin.dues', $data);
    // }

    // public function payments()
    // {
    //     $data['payments'] = Payment::with('user')
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //     return view('admin.payments', $data);
    // }

    public function categories()
    {
        $data['categories'] = DuesCategory::orderBy('created_at', 'desc')->get();
        return view('categories.index', $data);
    }

    // public function reports()
    // {
    //     $data['monthly_income'] = Payment::select(
    //         DB::raw('MONTH(created_at) as month'),
    //         DB::raw('SUM(nominal) as total')
    //     )
    //     ->whereYear('created_at', date('Y'))
    //     ->groupBy(DB::raw('MONTH(created_at)'))
    //     ->orderBy('month')
    //     ->get();

    //     $data['category_stats'] = Payment::select(
    //         'dues_categories.period as category',
    //         DB::raw('SUM(create_payment_tables.nominal) as total')
    //     )
    //     ->join('dues_categories', 'create_payment_tables.period', '=', 'dues_categories.period')
    //     ->whereYear('create_payment_tables.created_at', date('Y'))
    //     ->groupBy('dues_categories.period')
    //     ->get();

    //     return view('admin.reports', $data);
    // }

    public function officers()
    {
        $data['officers'] = Officer::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.officers', $data);
    }
}
