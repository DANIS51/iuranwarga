<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerCategori;
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
    Route::get('/users', [AdminController::class, 'users'])->name('admin.user');
    Route::get('/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/users/edit/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');


    // Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/officers', [AdminController::class, 'officers'])->name('admin.officers');
    Route::get('/officers/add', [AdminController::class, 'addOfficer'])->name('admin.officers.add');
    Route::post('/officers/store', [AdminController::class, 'storeOfficer'])->name('admin.officers.store');
    Route::delete('/officers/{id}', [AdminController::class, 'destroyOfficer'])->name('admin.officers.destroy');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/edit/{id}', [ControllerCategori::class, 'edit'])->name('categories-edit');
    Route::post('/categories/edit/{id}', [ControllerCategori::class, 'update'])->name('categories-update');
    Route::get('/members', [AdminController::class, 'members'])->name('admin.members');
    Route::get('/payments', [AdminController::class, 'payments']);

    Route::get('/dues', [AdminController::class, 'dues'])->name('admin.dues');
    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // API endpoints for dashboard data
    Route::get('/dashboard/data', [AdminController::class, 'getDashboardData'])->name('admin.dashboard.data');

});

// Category Routes
Route::prefix('categories')->group(function () {
    Route::get('/navbar', [CategoryController::class, 'navbarCategories'])->name('categories.navbar');
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/add', [CategoryController::class, 'addCategory'])->name('categories.add');
    Route::post('/store', [CategoryController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});



