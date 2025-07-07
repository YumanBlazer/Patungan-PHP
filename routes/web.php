<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome2');
})->name('welcome');

// Demo Dashboard (accessible without auth)
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/signup', [AuthController::class, 'showRegister']); // Alias for compatibility
    Route::post('/signup', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// API Routes for auth checking
Route::get('/api/auth/check', [AuthController::class, 'checkAuth'])->name('auth.check');

// Protected Routes
Route::middleware('auth')->group(function () {
    // User App Routes
    Route::prefix('app')->name('app.')->group(function () {
        Route::get('/', [DashboardController::class, 'userApp'])->name('index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::get('/history', [DashboardController::class, 'history'])->name('history');
        Route::get('/social', [DashboardController::class, 'social'])->name('social');
    });

    // Bill Management
    Route::resource('bills', BillController::class);
    Route::post('/bills/{bill}/join', [BillController::class, 'join'])->name('bills.join');
    Route::post('/bills/{bill}/leave', [BillController::class, 'leave'])->name('bills.leave');
    Route::post('/bills/{bill}/settle', [BillController::class, 'settle'])->name('bills.settle');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::get('/revenue', [AdminController::class, 'revenue'])->name('revenue');
        Route::get('/spending-analysis', [AdminController::class, 'spendingAnalysis'])->name('spending-analysis');
    });
});