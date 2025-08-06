<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function users()
    {
        $user = User::where('level', 'warga')->get();
        return view('admin.user',compact('user'));
    }
    // public function warga()
    // {
    //     return view('admin.warga');
    // }
    // public function settings()
    // {
    //     return view('admin.settings');
    // }
    // public function officers()
    // {
    //     return view('admin.officers');
    // }
    // public function categories()
    // {
    //     return view('admin.categories');
    // }
    // public function members()
    // {
    //     return view('admin.members');
    // }
    // public function payments()
    // {
    //     return view('admin.payments');
    // }
}
