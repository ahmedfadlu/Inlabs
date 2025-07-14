<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\Laboratorium2Controller;
use App\Http\Controllers\jadwallabController;
use Illuminate\Support\Facades\Route;

// Route Login Admin
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Route Dashboard Admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Group route yang butuh login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // CRUD Laboratorium
    Route::resource('laboratorium', Laboratorium2Controller::class);

    
    Route::resource('jadwal', JadwallabController::class);
});


