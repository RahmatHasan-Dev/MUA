<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\KomentarReport;
use App\Models\Pengeluaran;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationController extends Controller
{
    /**
     * Menampilkan daftar semua notifikasi (Halaman Riwayat).
     */
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Base queries
        $donasiQuery = Donasi::with('user');
        $laporanQuery = KomentarReport::with(['pelapor', 'komentar']);

        // Apply date filter if present
        if ($request->filled('start_date')) {
            $donasiQuery->where('created_at', '>=', $request->start_date);
            $laporanQuery->where('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $donasiQuery->where('created_at', '<=', $request->end_date);
            $laporanQuery->where('created_at', '<=', $request->end_date);
        }

        // Get data, map to a standard format
        $donasi = $donasiQuery->get()->map(function ($item) {
            $item->type = 'donasi';
            $item->sort_date = $item->created_at;
            return $item;
        });

        $laporan = $laporanQuery->get()->map(function ($item) {
            $item->type = 'laporan';
            $item->sort_date = $item->created_at;
            return $item;
        });

        // Gabungkan dan Sortir
        $merged = $donasi->merge($laporan)->sortByDesc('sort_date');

        // Pagination Manual
        $page = request()->get('page', 1);
        $perPage = 20;
        $offset = ($page * $perPage) - $perPage;

        $notifications = new LengthAwarePaginator(
            $merged->slice($offset, $perPage)->values(),
            $merged->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.notifications', compact('notifications'));
    }

    /**
     * Menandai semua notifikasi sebagai sudah dibaca.
     */
    public function markAsRead()
    {
        // Simpan timestamp saat ini ke session.
        // View akan menganggap semua notifikasi sebelum waktu ini sebagai "sudah dibaca".
        session(['admin_notif_read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Mengambil data notifikasi terbaru untuk navbar (AJAX).
     */
    public function fetchNotifications()
    {
        // Ambil timestamp terakhir dibaca (Mark All Read)
        $lastRead = session('admin_notif_read_at', '2000-01-01');

        // Hitung jumlah notifikasi yang belum dibaca (Badge Count)
        // Logika: Status Pending AND Created > Last Read
        $countDonasi = Donasi::where('status', 'pending')
            ->where('created_at', '>', $lastRead)
            ->count();

        $countLaporan = KomentarReport::where('status', 'pending')
            ->where('created_at', '>', $lastRead)
            ->count();

        $totalUnread = $countDonasi + $countLaporan;

        // Ambil data untuk dropdown (Preview 5 item terbaru)
        $notifDonasi = Donasi::where('status', 'pending')->with('user')->latest()->take(5)->get();
        $notifLaporan = KomentarReport::where('status', 'pending')->with('pelapor')->latest()->take(5)->get();
        $notifPengeluaran = Pengeluaran::latest()->take(3)->get();

        // Render HTML partial untuk dropdown
        $html = view('admin.partials.notification_items', compact('notifDonasi', 'notifLaporan', 'notifPengeluaran'))->render();

        return response()->json([
            'count' => $totalUnread,
            'html' => $html
        ]);
    }

    /**
     * Menandai satu notifikasi sebagai sudah dibaca (via session).
     */
    public function markSingleAsRead(Request $request)
    {
        $request->validate([
            'type' => 'required|in:donasi,laporan',
            'id' => 'required'
        ]);

        $type = $request->type;
        $id = $request->id;

        // Logika ini menyimpan notifikasi yang sudah di-klik ke session
        // agar tidak muncul lagi di dropdown, tapi tetap ada di halaman riwayat.
        if ($type == 'donasi') {
            $read = session('read_donasi_ids', []);
            if (!in_array($id, $read)) {
                session()->push('read_donasi_ids', $id);
            }
        } elseif ($type == 'laporan') {
            $read = session('read_laporan_ids', []);
            if (!in_array($id, $read)) {
                session()->push('read_laporan_ids', $id);
            }
        }

        return response()->json(['success' => true]);
    }
}