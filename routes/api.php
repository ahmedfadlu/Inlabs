<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\LaboratoriumController;
use App\Http\Controllers\API\InventarisController;
use App\Http\Controllers\API\JadwalLabController;
use App\Http\Controllers\API\PengaduanController;
use App\Http\Controllers\API\RiwayatPengaduanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);
Route::post('/users', [UsersController::class, 'store']);
Route::get('/users', [UsersController::class, 'index']);

Route::get('/labs', [LaboratoriumController::class, 'index']);

// routes/api.php

Route::get('/inventory', [InventarisController::class, 'index']);

Route::get('/jadwal', [JadwalLabController::class, 'index']);

Route::post('/pengaduan', [PengaduanController::class, 'store']);

// routes/api.php
Route::get('/pengaduan/user/{id}', [PengaduanController::class, 'getByUser']);

Route::get('/pengaduan-user/{id_user}', function($id_user) {
    $pengaduans = \App\Models\Pengaduan::where('id_user', $id_user)->get();
    return response()->json([
        'data' => $pengaduans
    ]);
});






// CRUD Users
Route::apiResource('users', UsersController::class);

// CRUD Laboratorium
Route::apiResource('laboratorium', LaboratoriumController::class);

// CRUD Inventaris
Route::apiResource('inventaris', InventarisController::class);

// CRUD Jadwal Lab
Route::apiResource('jadwal', JadwalLabController::class);

// CRUD Pengaduan
Route::apiResource('pengaduan', PengaduanController::class);

// CRUD Riwayat Pengaduan
Route::apiResource('riwayat', RiwayatPengaduanController::class);
