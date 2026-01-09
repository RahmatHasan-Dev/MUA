<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonasiController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\Api\AuthController;

// Route Login
Route::post('/login', [AuthController::class, 'login']);

// Route Protected (Butuh Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Route API Donasi (CRUD) - Hanya bisa diakses user login
    Route::apiResource('donasi', DonasiController::class);
});

// Route Callback Midtrans
Route::post('/midtrans-callback', [PaymentCallbackController::class, 'handle']);