<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KomentarReport;
use App\Models\Komentar;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;

class LaporanKomentarController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data laporan terbaru dengan relasi komentar dan pelapor
        $query = KomentarReport::with(['pelapor', 'komentar.pengguna']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $laporan = $query->latest()->paginate(10)->withQueryString();

        return view('admin.laporan.index', compact('laporan'));
    }

    public function markReviewed($id)
    {
        $laporan = KomentarReport::findOrFail($id);
        $laporan->update(['status' => 'reviewed']);

        return back()->with('success', 'Laporan berhasil ditandai sebagai sudah ditinjau.');
    }

    public function deleteComment($id)
    {
        $laporan = KomentarReport::findOrFail($id);

        // Hapus komentar jika masih ada
        if ($laporan->komentar) {
            $laporan->komentar->delete();
        }

        // Update status laporan jadi reviewed
        $laporan->update(['status' => 'reviewed']);

        return back()->with('success', 'Komentar berhasil dihapus dan laporan ditandai reviewed.');
    }

    public function reply(Request $request, $id)
    {
        $laporan = KomentarReport::findOrFail($id);
        
        $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        if (!$laporan->komentar) {
            return back()->with('error', 'Komentar sudah dihapus, tidak bisa membalas.');
        }

        // Buat balasan
        $komentar = Komentar::create([
            'id_berita' => $laporan->komentar->id_berita,
            'id_user' => auth()->id(),
            'isi' => $request->isi,
            'parent_id' => $laporan->komentar->id 
        ]);

        // Kirim Notifikasi ke pemilik komentar (jika ada)
        if ($laporan->komentar->user) {
            try {
                $laporan->komentar->user->notify(new NewReplyNotification($komentar));
            } catch (\Exception $e) {
                // Abaikan error notifikasi jika gagal
            }
        }

        $laporan->update(['status' => 'reviewed']);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }
}
