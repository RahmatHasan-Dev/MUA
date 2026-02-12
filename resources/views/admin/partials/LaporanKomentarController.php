<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KomentarReport;
use App\Models\Komentar;
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

    public function reply(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $laporan = KomentarReport::with('komentar')->findOrFail($id);

        if (!$laporan->komentar) {
            return back()->with('error', 'Komentar yang dilaporkan sudah dihapus, tidak bisa membalas.');
        }

        Komentar::create([
            'id_berita' => $laporan->komentar->id_berita,
            'id_user' => auth()->id(),
            'isi' => $request->isi,
            'parent_id' => $laporan->komentar->id 
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }
}