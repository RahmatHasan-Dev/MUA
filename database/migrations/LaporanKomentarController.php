<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KomentarReport;
use Illuminate\Http\Request;

class LaporanKomentarController extends Controller
{
    public function index()
    {
        // Mengambil data laporan terbaru dengan relasi komentar dan pelapor
        $laporan = KomentarReport::with(['komentar', 'pelapor'])
            ->latest()
            ->paginate(10);

        return view('admin.laporan.index', compact('laporan'));
    }

    public function markReviewed($id)
    {
        $laporan = KomentarReport::findOrFail($id);
        $laporan->update(['status' => 'reviewed']);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui menjadi reviewed.');
    }

    public function deleteComment($id)
    {
        $laporan = KomentarReport::with('komentar')->findOrFail($id);

        if ($laporan->komentar) {
            $laporan->komentar->delete();
        }

        $laporan->update(['status' => 'reviewed']);

        return redirect()->back()->with('success', 'Komentar berhasil dihapus dan laporan ditandai reviewed.');
    }
}