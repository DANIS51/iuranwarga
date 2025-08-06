<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');




Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');

    // Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/officers', [AdminController::class, 'officers'])->name('admin.officers');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/members', [AdminController::class, 'members'])->name('admin.members');
    Route::get('/payments', [AdminController::class, 'payments']);
});



