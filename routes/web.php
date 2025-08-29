<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ControllerCategori;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/home', '/');

Route::get('/welcome', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard umum
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

// Admin routes
Route::prefix('admin')->middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'dashboard'])->name('admin');
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard/data', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'getDashboardData'])->name('admin.dashboard.data');

    // Users
    Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'users'])->name('admin.user');
    Route::get('/users/edit/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/users/edit/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroyUser'])->name('admin.users.destroy');

    // Officers
    Route::get('/officers', [\App\Http\Controllers\Admin\AdminOfficerController::class, 'officers'])->name('admin.officers');
    Route::get('/officers/add', [\App\Http\Controllers\Admin\AdminOfficerController::class, 'addOfficer'])->name('admin.officers.add');
    Route::post('/officers/store', [\App\Http\Controllers\Admin\AdminOfficerController::class, 'storeOfficer'])->name('admin.officers.store');
    Route::delete('/officers/{id}', [\App\Http\Controllers\Admin\AdminOfficerController::class, 'destroyOfficer'])->name('admin.officers.destroy');

    // Members
    Route::get('/members', [\App\Http\Controllers\Admin\AdminMemberController::class, 'members'])->name('admin.members');
    Route::get('/members/add', [\App\Http\Controllers\Admin\AdminMemberController::class, 'create'])->name('admin.members.add');
    Route::post('/members', [\App\Http\Controllers\Admin\AdminMemberController::class, 'store'])->name('admin.members.store');
    Route::get('/members/{id}/payments', [\App\Http\Controllers\Admin\AdminMemberController::class, 'payments'])->name('admin.members.payments');

    // Dues
    Route::get('/dues', [\App\Http\Controllers\Admin\AdminDuesController::class, 'dues'])->name('admin.dues');
    Route::get('/reports', [\App\Http\Controllers\Admin\AdminDuesController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [\App\Http\Controllers\Admin\AdminDuesController::class, 'settings'])->name('admin.settings');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/edit/{id}', [ControllerCategori::class, 'edit'])->name('categories-edit');
    Route::post('/categories/edit/{id}', [ControllerCategori::class, 'update'])->name('categories-update');

    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');


    Route::delete('/categories/{id}', [ControllerCategori::class, 'destroy'])->name('categories.destroy');


    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('admin.payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('admin.payments.store');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('admin.payments.show');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('admin.payments.edit');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('admin.payments.update');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('admin.payments.destroy');
    Route::get('/payments/history/{userId}', [PaymentController::class, 'userHistory'])->name('payments.history');
});

// Category routes (frontend)
Route::prefix('categories')->group(function () {
    Route::get('/navbar', [CategoryController::class, 'navbarCategories'])->name('categories.navbar');
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/add', [CategoryController::class, 'addCategory'])->name('categories.add');
    Route::post('/store', [CategoryController::class, 'storeCategory'])->name('categories.store');
});
