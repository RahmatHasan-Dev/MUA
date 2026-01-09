<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDonasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Donasi::with('user')->latest('tanggal');

        // Filter Pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })->orWhere('id_donasi', 'like', "%{$search}%");
        }

        // Filter Tanggal
        if ($request->start_date) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $donations = $query->get();

        // Statistik untuk Kartu Atas
        $totalDonasi = $donations->where('status', 'berhasil')->sum('nominal');
        $jumlahTransaksi = $donations->count();
        $donasiPending = $donations->where('status', 'pending')->count();

        // Data Grafik Tren (12 Bulan Terakhir)
        $trend = Donasi::select(
                DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as month"),
                DB::raw('SUM(nominal) as total')
            )
            ->where('status', 'berhasil')
            ->where('tanggal', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = $trend->pluck('month')->map(function($m) {
            return Carbon::parse($m)->format('M Y');
        });
        $chartValues = $trend->pluck('total');

        // Data Grafik Pie Status
        $pieLabels = ['Berhasil', 'Pending', 'Gagal'];
        $pieValues = [
            $donations->where('status', 'berhasil')->count(),
            $donations->where('status', 'pending')->count(),
            $donations->where('status', 'gagal')->count(),
        ];

        return view('admin.dashboard', compact(
            'donations',
            'totalDonasi',
            'jumlahTransaksi',
            'donasiPending',
            'chartLabels',
            'chartValues',
            'pieLabels',
            'pieValues'
        ));
    }

    public function show($id)
    {
        $donation = Donasi::with('user')->findOrFail($id);
        return view('admin.show', compact('donation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1'
        ]);

        $donation = Donasi::findOrFail($id);
        $donation->nominal = $request->nominal;
        $donation->save();

        return redirect()->back()->with('success', 'Nominal donasi berhasil diperbarui.');
    }

    public function updateStatus(Request $request, $id)
    {
        $donation = Donasi::findOrFail($id);
        $donation->status = $request->status;
        if ($request->has('catatan')) {
            $donation->catatan = $request->catatan;
        }
        $donation->save();

        return redirect()->back()->with('success', 'Status donasi berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $query = Donasi::with('user')->latest('tanggal');

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->start_date) {
            $query->whereDate('tanggal', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('tanggal', '<=', $request->end_date);
        }

        $donations = $query->get();

        $pdf = Pdf::loadView('admin.pdf_report', compact('donations'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('laporan-donasi.pdf');
    }
}