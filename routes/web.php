<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    // Mengambil data statistik untuk ditampilkan di halaman depan
    $totalDonasi = \App\Models\Donasi::sum('nominal');
    $jumlahTransaksi = \App\Models\Donasi::count();
    return view('index', compact('totalDonasi', 'jumlahTransaksi'));
})->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/visimisi', function () {
    return view('visimisi');
})->name('visimisi');

Route::get('/kegiatan', function () {
    return view('kegiatan');
})->name('kegiatan');

Route::get('/partnership', function () {
    return view('partnership');
})->name('partnership');

Route::get('/donasi', function() {
    $riwayat = [];
    if (\Illuminate\Support\Facades\Auth::check()) {
        $riwayat = \App\Models\Donasi::where('id_user', \Illuminate\Support\Facades\Auth::id())->orderBy('tanggal', 'desc')->get();
    }
    return view('donasi', compact('riwayat'));
})->name('donasi');

Route::get('/fun-fact', function () {
    return view('fun-fact');
})->name('fun-fact');

Route::get('/terima-kasih', function () {
    return view('thankyou');
})->name('thankyou');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/donasi', [DonationController::class, 'store'])->name('donasi.submit');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Settings Route
Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('auth');
Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update')->middleware('auth');

// Admin Dashboard placeholder
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');
Route::patch('/admin/donasi/{id}/status', [AdminController::class, 'updateStatus'])->middleware('auth')->name('admin.donasi.status');
Route::put('/admin/donasi/{id}', [AdminController::class, 'update'])->middleware('auth')->name('admin.donasi.update');
Route::get('/admin/donasi/{id}/detail', [AdminController::class, 'show'])->middleware('auth')->name('admin.show');
Route::get('/admin/export', [AdminController::class, 'export'])->middleware('auth')->name('admin.export');
Route::get('/admin/export-pdf', [AdminController::class, 'exportPdf'])->middleware('auth')->name('admin.export.pdf');