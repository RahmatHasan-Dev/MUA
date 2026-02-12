<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    /**
     * Get list of news/campaigns.
     * Endpoint: GET /api/berita
     */
    public function index()
    {
        // Ambil berita terbaru
        $berita = Berita::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'status'  => true,
            'message' => 'Daftar berita berhasil diambil',
            'data'    => $berita
        ], 200);
    }

    /**
     * Get detail of a news.
     * Endpoint: GET /api/berita/{id}
     */
    public function show($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['status' => false, 'message' => 'Berita tidak ditemukan'], 404);
        }

        return response()->json([
            'status'  => true,
            'data'    => $berita
        ], 200);
    }
}