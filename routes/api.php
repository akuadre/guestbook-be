<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\PegawaiController;
use App\Http\Controllers\API\BukuTamuController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\JabatanController;

// PUBLIC ROUTES - untuk input buku tamu
Route::get('/guestbook/data', [BukuTamuController::class, 'getFormData']);
Route::post('/guestbook/store', [BukuTamuController::class, 'storeUser']);

// PUBLIC ROUTES - Authentication
Route::post('/login', [AuthController::class, 'login']);

// PROTECTED ROUTES
Route::middleware(['auth:sanctum'])->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Buku Tamu routes
    Route::get('/bukutamu', [BukuTamuController::class, 'index']);
    Route::get('/bukutamu/grafik', [BukuTamuController::class, 'getGrafikData']);
    Route::get('/bukutamu/{id}', [BukuTamuController::class, 'show']);
    Route::post('/bukutamu', [BukuTamuController::class, 'store']);
    Route::delete('/bukutamu/{id}', [BukuTamuController::class, 'destroy']);

    // Siswa routes
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/{id}', [SiswaController::class, 'show']);
    Route::post('/siswa', [SiswaController::class, 'store']);
    Route::put('/siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);

    // Pegawai routes
    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/pegawai/{id}', [PegawaiController::class, 'show']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update']);
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy']);
    Route::get('/pegawai-jabatan/list', [PegawaiController::class, 'getJabatans']); // untuk dropdown jabatan

    // Jabatan routes
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::get('/jabatan/{id}', [JabatanController::class, 'show']);
    Route::post('/jabatan', [JabatanController::class, 'store']);
    Route::put('/jabatan/{id}', [JabatanController::class, 'update']);
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy']);
});
