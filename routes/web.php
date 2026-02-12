<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController; // Pastikan ini ada
use App\Http\Controllers\Auth\RegisterController; // Pastikan ini ada
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController; // Tambahkan ini
use App\Http\Middleware\IsAdmin; // Import Middleware IsAdmin di sini
use App\Http\Controllers\Admin\PartnershipController; // Import Controller Partnership
use App\Http\Controllers\Admin\NotificationController; // Import NotificationController
use App\Http\Controllers\Admin\VisiMisiController as AdminVisiMisiController; // Alias biar gak bentrok
use App\Http\Controllers\VisiMisiController; // Controller Public
use App\Http\Controllers\Admin\LaporanKomentarController;

// Route untuk User Biasa (Index 1)
Route::get('/index1', function () {
    // Mengambil data statistik untuk ditampilkan di halaman depan
    $totalDonasi = \App\Models\Donasi::where('status', 'berhasil')->sum('nominal');
    $jumlahTransaksi = \App\Models\Donasi::count();
    $jumlahUser = \App\Models\User::count();
    return view('index1', compact('totalDonasi', 'jumlahTransaksi', 'jumlahUser'));
})->name('user.home');

// Redirect root ke login atau halaman umum
Route::get('/', function() {
    $totalDonasi = \App\Models\Donasi::where('status', 'berhasil')->sum('nominal');
    $jumlahTransaksi = \App\Models\Donasi::count();
    $jumlahUser = \App\Models\User::count();

    // Jika user login dan role-nya admin, tampilkan index2 (Beranda Admin)
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('index2', compact('totalDonasi', 'jumlahTransaksi', 'jumlahUser'));
    }

    return view('index1', compact('totalDonasi', 'jumlahTransaksi', 'jumlahUser'));
})->name('home');

// Route Dashboard Umum (Pintu Masuk Pintar)
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.home');
})->middleware('auth')->name('dashboard');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/chart-data', [AboutController::class, 'getChartData'])->name('about.chart-data');

Route::get('/visimisi', [VisiMisiController::class, 'index'])->name('visimisi');

// Route::get('/kegiatan', function () {return view('kegiatan');})->name('kegiatan');

Route::get('/partnership', [AdminController::class, 'partnershipIndex'])->name('partnership');
Route::get('/partnership/{id}', [AdminController::class, 'partnershipDetail'])->name('partnership.detail');

Route::get('/donasi', function() {
    $riwayat = [];
    if (\Illuminate\Support\Facades\Auth::check()) {
        $riwayat = \App\Models\Donasi::where('id_user', \Illuminate\Support\Facades\Auth::id())->orderBy('tanggal', 'desc')->get();
    }

    // Hitung progress donasi per program (Hanya yang statusnya berhasil)
    $progSatwa = \App\Models\Donasi::where('jenis', 'satwa')->where('status', 'berhasil')->sum('nominal');
    $progKarang = \App\Models\Donasi::where('jenis', 'karang')->where('status', 'berhasil')->sum('nominal');
    $progBakau = \App\Models\Donasi::where('jenis', 'bakau')->where('status', 'berhasil')->sum('nominal');

    // Target Donasi (Dummy/Hardcoded untuk demo)
    $targetSatwa = 50000000; // 50 Juta
    $targetKarang = 100000000; // 100 Juta
    $targetBakau = 30000000; // 30 Juta

    // Top Donatur (Mengambil 5 donatur tertinggi)
    $topDonatur = \App\Models\Donasi::select('id_user', \Illuminate\Support\Facades\DB::raw('SUM(nominal) as total_donasi'))
        ->where('status', 'berhasil')
        ->whereNotNull('id_user') // Hanya user terdaftar
        ->groupBy('id_user')
        ->orderByDesc('total_donasi')
        ->take(5)
        ->with('user')
        ->get();

    return view('donasi', compact('riwayat', 'progSatwa', 'progKarang', 'progBakau', 'targetSatwa', 'targetKarang', 'targetBakau', 'topDonatur'));
})->name('donasi');

Route::get('/donasi/sukses', function (\Illuminate\Http\Request $request) {
    // Ambil ID donasi dari Midtrans (format: ID-TIMESTAMP)
    $orderId = $request->query('order_id');
    $donasiId = $orderId ? explode('-', $orderId)[0] : null;

    // Redirect kembali ke halaman donasi dengan "Flash Session"
    // Flash session otomatis hilang setelah refresh, jadi konfeti hanya muncul sekali.
    return redirect()->route('donasi')
        ->with('show_success_modal', true)
        ->with('donasi_id', $donasiId);
})->name('donasi.sukses');

Route::get('/funfact', function () {
    return view('funfact');
})->name('funfact');

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
// Route Webhook Midtrans (Wajib POST)
Route::post('/payment/notification', [DonationController::class, 'notificationCallback'])->name('payment.notification');


// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Profile Routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Settings Route
Route::get('/settings', [SettingsController::class, 'index'])->name('settings')->middleware('auth');
Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update')->middleware('auth');

Route::get('/kegiatan', [AdminController::class, 'kegiatanIndex'])->name('kegiatan');
Route::get('/kegiatan/{id}', [AdminController::class, 'kegiatanDetail'])->name('kegiatan.detail');
Route::post('/kegiatan/{id}/komentar', [AdminController::class, 'storeKomentar'])->name('kegiatan.komentar.store')->middleware('auth');
Route::post('/komentar/{id}/like', [AdminController::class, 'likeKomentar'])->name('komentar.like')->middleware('auth');
Route::delete('/komentar/{id}', [AdminController::class, 'deleteKomentar'])->name('komentar.delete')->middleware('auth');
Route::post('/komentar/{id}/report', [AdminController::class, 'reportKomentar'])->name('komentar.report')->middleware('auth');
Route::get('/donasi', [AdminController::class, 'donasiIndex'])->name('donasi');
Route::get('/funfact', [AdminController::class, 'funfactIndex'])->name('funfact');

// donasi
Route::get('/donasi', [AdminController::class, 'donasiIndex'])->name('donasi');
Route::get('/funfact', [AdminController::class, 'funfactIndex'])->name('funfact');

// Admin Dashboard placeholder
Route::middleware(['auth', IsAdmin::class])->group(function () { // Ganti 'admin' jadi IsAdmin::class
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::patch('/admin/donasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.donasi.status');
    Route::put('/admin/donasi/{id}', [AdminController::class, 'update'])->name('admin.donasi.update');
    Route::get('/admin/donasi/{id}/detail', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/pemasukan', [AdminController::class, 'pemasukan'])->name('admin.pemasukan');
    Route::get('/admin/pengeluaran', [AdminController::class, 'pengeluaran'])->name('admin.pengeluaran');
    Route::post('/admin/pengeluaran', [AdminController::class, 'storePengeluaran'])->name('admin.pengeluaran.store');
    Route::put('/admin/pengeluaran/{id}', [AdminController::class, 'updatePengeluaran'])->name('admin.pengeluaran.update');
    Route::get('/admin/pengeluaran/{id}/cetak', [AdminController::class, 'cetakPengeluaran'])->name('admin.pengeluaran.cetak');
    Route::delete('/admin/pengeluaran/{id}', [AdminController::class, 'destroyPengeluaran'])->name('admin.pengeluaran.destroy');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/block', [AdminController::class, 'toggleBlockUser'])->name('admin.users.block');
    Route::get('/admin/users/{id}/detail', [AdminController::class, 'showUser'])->name('admin.users.show');
    Route::get('/admin/users/export', [AdminController::class, 'exportUsers'])->name('admin.users.export');
    Route::get('/admin/bukti', [AdminController::class, 'bukti'])->name('admin.bukti');

    // Routes Laporan Komentar
    Route::get('/admin/laporan-komentar', [LaporanKomentarController::class, 'index'])->name('admin.laporan.index');
    Route::patch('/admin/laporan-komentar/{id}/reviewed', [LaporanKomentarController::class, 'markReviewed'])->name('admin.laporan.reviewed');
    Route::delete('/admin/laporan-komentar/{id}/delete-comment', [LaporanKomentarController::class, 'deleteComment'])->name('admin.laporan.delete_comment');
    Route::post('/admin/laporan-komentar/{id}/reply', [LaporanKomentarController::class, 'reply'])->name('admin.laporan.reply');

    // Tambahan dari Didi
    
    // --- ROUTES PARTNERSHIP ---
    Route::resource('admin/partnerships', PartnershipController::class)->names([
        'index' => 'admin.partnerships.index',
        'create' => 'admin.partnerships.create',
        'store' => 'admin.partnerships.store',
        'edit' => 'admin.partnerships.edit',
        'update' => 'admin.partnerships.update',
        'destroy' => 'admin.partnerships.destroy',
    ]);
    Route::post('admin/partnerships/reorder', [PartnershipController::class, 'reorder'])->name('admin.partnerships.reorder');

    // --- ROUTE DARURAT (Jalankan Migrasi via Browser) ---
    Route::get('/run-migration', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate');
        return '<h1>Migrasi Berhasil!</h1><p>Kolom "urutan" telah ditambahkan ke database.</p><a href="/admin/partnerships">Kembali ke Admin Partnership</a>';
    });

    // --- ROUTES VISI MISI ---
    Route::resource('admin/visimisi', AdminVisiMisiController::class)->names([
        'index' => 'admin.visimisi.index',
        'create' => 'admin.visimisi.create',
        'store' => 'admin.visimisi.store',
        'edit' => 'admin.visimisi.edit',
        'update' => 'admin.visimisi.update',
        'destroy' => 'admin.visimisi.destroy',
    ]);
    Route::post('admin/visimisi/reorder', [AdminVisiMisiController::class, 'reorder'])->name('admin.visimisi.reorder');

    Route::get('/admin/berita', [AdminController::class, 'berita'])->name('admin.berita');
    Route::get('/admin/berita/export', [AdminController::class, 'beritaExport'])->name('admin.berita.export');
    Route::get('/admin/berita/{id}/edit', [AdminController::class, 'beritaEdit'])->name('admin.berita.edit');
    Route::get('/admin/berita/add', [AdminController::class, 'beritaAdd'])->name('admin.berita.add');
    Route::post('/admin/berita', [AdminController::class, 'beritaStore'])->name('admin.berita.store');
    Route::patch('/admin/berita/{id}', [AdminController::class, 'beritaUpdate'])->name('admin.berita.update');
    Route::delete('/admin/berita/{id}/hapus', [AdminController::class, 'beritaDelete'])->name('admin.berita.delete');
    Route::get('/admin/campaign', [AdminController::class, 'campaign'])->name('admin.campaign');
    Route::get('/admin/campaign/export', [AdminController::class, 'campaignExport'])->name('admin.campaign.export');
    Route::get('/admin/campaign/{id}/edit', [AdminController::class, 'campaignEdit'])->name('admin.campaign.edit');
    Route::get('/admin/campaign/add', [AdminController::class, 'campaignAdd'])->name('admin.campaign.add');
    Route::post('/admin/campaign', [AdminController::class, 'campaignStore'])->name('admin.campaign.store');
    Route::patch('/admin/campaign/{id}', [AdminController::class, 'campaignUpdate'])->name('admin.campaign.update');
    Route::delete('/admin/campaign/{id}/hapus', [AdminController::class, 'campaignDelete'])->name('admin.campaign.delete');

    
    Route::get('/admin/funfact', [AdminController::class, 'funfact'])->name('admin.funfact');
    Route::get('/admin/funfact/export', [AdminController::class, 'funfactExport'])->name('admin.funfact.export');
    Route::get('/admin/funfact/{id}/edit', [AdminController::class, 'funfactEdit'])->name('admin.funfact.edit');
    Route::get('/admin/funfact/add', [AdminController::class, 'funfactAdd'])->name('admin.funfact.add');
    Route::post('/admin/funfact', [AdminController::class, 'funfactStore'])->name('admin.funfact.store');
    Route::patch('/admin/funfact/{id}', [AdminController::class, 'funfactUpdate'])->name('admin.funfact.update');
    Route::delete('/admin/funfact/{id}/hapus', [AdminController::class, 'funfactDelete'])->name('admin.funfact.delete');
    
    
    // Routes Tools
    Route::get('/admin/tools', [AdminController::class, 'tools'])->name('admin.tools');
    Route::post('/admin/tools/cache', [AdminController::class, 'clearCache'])->name('admin.tools.cache');
    Route::post('/admin/tools/backup', [AdminController::class, 'backupDatabase'])->name('admin.tools.backup');
    Route::post('/admin/tools/fix-storage', [AdminController::class, 'fixStorage'])->name('admin.tools.fix-storage');
    Route::post('/admin/tools/email', [AdminController::class, 'testEmail'])->name('admin.tools.email');

    // Routes Withdrawal (Pengambilan Dana)
    Route::get('/admin/withdrawal', [AdminController::class, 'withdrawal'])->name('admin.withdrawal');
    Route::post('/admin/withdrawal', [AdminController::class, 'storeWithdrawal'])->name('admin.withdrawal.store');

    Route::get('/admin/export-view', [AdminController::class, 'exportView'])->name('admin.export.view');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/export-pdf', [AdminController::class, 'exportPdf'])->name('admin.export.pdf');
    Route::get('/admin/export-pdf-email', [AdminController::class, 'emailPdf'])->name('admin.export.pdf.email');

    // Routes Notifikasi AJAX
    Route::get('/admin/notifications/fetch', [NotificationController::class, 'fetchNotifications'])->name('admin.notifications.fetch');
    Route::post('/admin/notifications/read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/admin/notifications/read-single', [NotificationController::class, 'markSingleAsRead'])->name('admin.notifications.read.single');
    Route::get('/admin/notifications', [NotificationController::class, 'index'])->name('admin.notifications');

    // Route Profil Admin
    Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::delete('/admin/profile/photo', [AdminController::class, 'deleteProfilePhoto'])->name('admin.profile.delete_photo');
});