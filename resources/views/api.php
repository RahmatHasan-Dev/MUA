<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Test koneksi untuk Postman: http://127.0.0.1:8000/api/test
Route::get('/test', function () {
    return response()->json(['status' => 'success', 'message' => 'Koneksi API Berhasil']);
});

// Routes untuk Donasi (CRUD)
// URL: http://127.0.0.1:8000/api/donasi
Route::controller(DonasiController::class)->group(function () {
    Route::get('/donasi', 'index');       // GET All
    Route::post('/donasi', 'store');      // POST Create
    Route::get('/donasi/{id}', 'show');   // GET Detail
});