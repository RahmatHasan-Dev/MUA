<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\User;
use Carbon\Carbon;

class AboutController extends Controller
{
    public function index()
    {
        // Data Statistik Utama (All Time)
        $totalDonasi = Donasi::where('status', 'berhasil')->sum('nominal');
        $jumlahTransaksi = Donasi::count();
        $jumlahUser = User::count();

        // Ambil daftar tahun yang tersedia di database untuk filter
        $years = Donasi::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('about', compact('totalDonasi', 'jumlahTransaksi', 'jumlahUser', 'years'));
    }

    public function getChartData(Request $request)
    {
        $year = $request->input('year', date('Y'));

        // 1. Data Tren Donasi Bulanan (Line/Area Chart)
        // Mengambil data per bulan untuk tahun yang dipilih
        $trendData = Donasi::selectRaw("DATE_FORMAT(tanggal, '%m') as month, SUM(nominal) as total")
            ->whereYear('tanggal', $year)
            ->where('status', 'berhasil')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->toArray();

        // Mengisi bulan yang kosong dengan 0 agar grafik tetap mulus 12 bulan
        $trendLabels = [];
        $trendValues = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthKey = str_pad($i, 2, '0', STR_PAD_LEFT); // 01, 02, ...
            $trendLabels[] = Carbon::create()->month($i)->translatedFormat('F'); // Nama Bulan
            $trendValues[] = $trendData[$monthKey] ?? 0;
        }

        // 2. Data Status Donasi (Pie Chart)
        $statusData = Donasi::selectRaw('status, count(*) as total')
            ->whereYear('tanggal', $year)
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Pastikan urutan status konsisten
        $statuses = ['berhasil', 'pending', 'gagal'];
        $pieValues = [];
        foreach ($statuses as $status) {
            $pieValues[] = $statusData[$status] ?? 0;
        }
        $pieLabels = array_map('ucfirst', $statuses);

        return response()->json([
            'trend' => [
                'labels' => $trendLabels,
                'data' => $trendValues
            ],
            'status' => [
                'labels' => $pieLabels,
                'data' => $pieValues
            ]
        ]);
    }
}