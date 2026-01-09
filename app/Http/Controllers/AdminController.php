<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationStatusChanged;
use App\Services\WhatsAppService; // Import Service
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF Facade

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Base Query
        $query = Donasi::query();

        // Filter Berdasarkan Tanggal jika ada input
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('tanggal', '>=', $request->start_date)
                  ->whereDate('tanggal', '<=', $request->end_date);
        }

        // Filter Pencarian Berdasarkan Nama Donatur
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Filter Berdasarkan Jenis Program
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Analisis Data untuk Dashboard
        // Kita clone $query agar filter tanggal tetap terbawa pada setiap perhitungan
        // 1. Menghitung Total Donasi yang Berhasil (Sum)
        $totalDonasi = (clone $query)->sum('nominal');

        // 2. Menghitung Jumlah Transaksi Masuk (Count)
        $jumlahTransaksi = (clone $query)->count();

        // 3. Menghitung Donasi Pending
        $donasiPending = 0; // (clone $query)->where('status', 'pending')->count();

        // 4. Data Grafik Tren Donasi Bulanan (Chart.js)
        // Mengambil data 12 bulan terakhir
        $grafikData = Donasi::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, SUM(nominal) as total')
            // ->where('status', 'berhasil')
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        $chartLabels = $grafikData->pluck('bulan')->map(function($date) {
            return \Carbon\Carbon::createFromFormat('Y-m', $date)->format('M Y');
        });
        $chartValues = $grafikData->pluck('total');

        // 5. Data Pie Chart Status Donasi
        $statusData = Donasi::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();
        
        $pieLabels = array_keys($statusData);
        $pieValues = array_values($statusData);

        // Ambil data untuk tabel
        $donations = $query->with('user')->orderBy('tanggal', 'desc')->get();
        
        // Jika Request adalah AJAX (dari pencarian), kembalikan hanya baris tabel
        if ($request->ajax()) {
            return view('admin.partials.donasi_rows', compact('donations'));
        }

        return view('admin.dashboard', compact('donations', 'totalDonasi', 'jumlahTransaksi', 'donasiPending', 'chartLabels', 'chartValues', 'pieLabels', 'pieValues'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,berhasil,gagal',
            'catatan' => 'nullable|string|max:255',
        ]);
        $donation = Donasi::where('id_donasi', $id)->firstOrFail();
        $donation->status = $request->status;
        $donation->catatan = $request->catatan; // Simpan catatan
        $donation->save();

        // Kirim Email Notifikasi jika user memiliki email
        if ($donation->user && $donation->user->email) {
            Mail::to($donation->user->email)->queue(new DonationStatusChanged($donation));
        }

        // Kirim Notifikasi WhatsApp (Jika user punya No HP)
        if ($donation->user && $donation->user->no_hp) {
            try {
                $waService = new WhatsAppService();
                $pesan = "Halo {$donation->user->nama},\n\nStatus donasi Anda ID #{$donation->id_donasi} telah diperbarui menjadi: " . strtoupper($request->status) . ".\n\nTerima kasih telah mendukung Menadah Untuk Alam.";
                
                // Kirim (bisa di-queue juga jika ingin async penuh)
                $waService->send($donation->user->no_hp, $pesan);
            } catch (\Exception $e) {
                // Jangan biarkan error WA menghentikan proses update status
            }
        }

        return back()->with('success', 'Status donasi berhasil diperbarui.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1',
        ]);

        $donation = Donasi::findOrFail($id);
        $donation->update(['nominal' => $request->nominal]);

        return back()->with('success', 'Nominal donasi berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        // Gunakan logika filter yang sama dengan dashboard
        $query = Donasi::query();

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });
        }

        // Filter Berdasarkan Status (Tambahan Baru)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter Berdasarkan Jenis (Tambahan Baru)
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $donations = $query->with('user')->orderBy('tanggal', 'desc')->get();

        // Persiapan file CSV
        $filename = "laporan_donasi_" . date('Y-m-d_H-i-s') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Tanggal', 'Donatur', 'Email', 'Program', 'Nominal', 'Status']);

            foreach ($donations as $donasi) {
                fputcsv($file, [
                    $donasi->id_donasi,
                    $donasi->tanggal,
                    $donasi->user->nama ?? 'Guest',
                    $donasi->user->email ?? '-',
                    $donasi->jenis,
                    $donasi->nominal,
                    $donasi->status
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        // Gunakan logika filter yang sama (bisa di-refactor ke private method agar DRY)
        $query = Donasi::query();
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }
        // ... (tambahkan filter lain jika perlu)

        $donations = $query->with('user')->orderBy('tanggal', 'desc')->get();
        $pdf = Pdf::loadView('admin.pdf_report', compact('donations'));
        return $pdf->download('laporan_donasi_mua.pdf');
    }

    public function show($id)
    {
        $donation = Donasi::with('user')->findOrFail($id);
        return view('admin.show', compact('donation'));
    }
}
