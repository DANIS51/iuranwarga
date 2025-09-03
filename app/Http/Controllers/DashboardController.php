<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Role-based dashboard redirection
        switch ($user->level) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'officer':
                return redirect()->route('officer.dashboard');
            case 'warga':
                return redirect()->route('warga.dashboard');
            default:
                return redirect()->route('home');
        }
    }
}
