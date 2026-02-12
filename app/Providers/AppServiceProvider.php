<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Donasi;
use App\Models\KomentarReport;
use App\Models\Pengeluaran;






class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // --- LOGIKA NOTIFIKASI GLOBAL (View Composer) ---
        // Ini akan menyuntikkan variabel notifikasi ke navbar admin secara otomatis
        // setiap kali view 'admin.partials.navbar-admin' dirender.
        View::composer('admin.partials.navbar-admin', function ($view) {
            
            // 1. Ambil timestamp "Mark All Read" dari session
            // Default ke tahun 2000 jika belum ada session (artinya semua notifikasi dianggap baru)
            $lastRead = session('admin_notif_read_at', '2000-01-01');

            // 2. Hitung Badge (Jumlah Notifikasi Baru)
            // Logika: Status harus 'pending' DAN dibuat SETELAH waktu 'lastRead'
            $countDonasi = Donasi::where('status', 'pending')
                ->where('created_at', '>', $lastRead)
                ->count();

            $countLaporan = KomentarReport::where('status', 'pending')
                ->where('created_at', '>', $lastRead)
                ->count();

            // 3. Ambil Data Preview untuk Dropdown (5 item terbaru)
            // Kita tetap mengambil list pending meskipun sudah dibaca, agar admin tetap bisa akses cepat
            $notifDonasi = Donasi::where('status', 'pending')
                ->with('user')
                ->latest()
                ->take(5)
                ->get();

            $notifLaporan = KomentarReport::where('status', 'pending')
                ->with('pelapor')
                ->latest()
                ->take(5)
                ->get();

            $notifPengeluaran = Pengeluaran::latest()
                ->take(3)
                ->get();

            // 4. Kirim variabel ke view
            $view->with([
                'countDonasi' => $countDonasi,
                'countLaporan' => $countLaporan,
                'notifDonasi' => $notifDonasi,
                'notifLaporan' => $notifLaporan,
                'notifPengeluaran' => $notifPengeluaran,
            ]);
        });
    }
}
