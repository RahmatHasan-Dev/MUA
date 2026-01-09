<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonasiController;
use App\Http\Controllers\PaymentCallbackController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route API Donasi (Otomatis membuat index, store, show, update, destroy)
// Endpoint: POST /api/donasi
Route::apiResource('donasi', DonasiController::class);

// Route Callback Midtrans
Route::post('/midtrans-callback', [PaymentCallbackController::class, 'handle']);