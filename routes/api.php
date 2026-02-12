<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonasiController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PaymentCallbackController;

// =======================
// AUTH
// =======================
Route::post('/login', [AuthController::class, 'login']);

// =======================
// PUBLIC ROUTES
// =======================
// Berita (tanpa login)
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'show']);

// Callback Midtrans (WAJIB public)
Route::post('/midtrans-callback', [PaymentCallbackController::class, 'handle']);

// =======================
// PROTECTED ROUTES
// =======================
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route API Donasi (CRUD)
    Route::apiResource('donasi', DonasiController::class);

    // Route Khusus: Lihat riwayat donasi berdasarkan ID User
    Route::get('/donasi/user/{id}', [DonasiController::class, 'historyByUser']);
});
