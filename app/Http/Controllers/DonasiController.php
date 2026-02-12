<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    /**
     * Handle incoming donation history request.
     * Endpoint: GET /api/donasi
     */
    public function index(Request $request)
    {
        // Ambil user yang sedang login (dari token)
        $user = $request->user();

        // Ambil data donasi milik user tersebut
        $donasi = Donasi::where('id_user', $user->id)->orderBy('tanggal', 'desc')->get();

        return response()->json([
            'status'  => true,
            'message' => 'Riwayat donasi berhasil diambil',
            'data'    => $donasi
        ], 200);
    }

    /**
     * Handle incoming donation request.
     * Endpoint: POST /api/donasi
     */
    public function store(Request $request)
    {
        // 1. Validasi Data JSON yang masuk
        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:pengguna,id', // Pastikan user ada di tabel pengguna
            'jenis'   => 'required|string',
            'nominal' => 'required|numeric|min:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            // 2. Simpan ke Database (Tabel Donasi)
            $donasi = Donasi::create([
                'id_user' => $request->id_user,
                'jenis'   => $request->jenis,
                'nominal' => $request->nominal,
                'tanggal' => now(),       // Set tanggal hari ini
                'status'  => 'pending',   // Default status pending
                'catatan' => 'Donasi via API',
            ]);

            // 3. Berikan Respon Sukses (JSON)
            return response()->json([
                'status'  => true,
                'message' => 'Donasi berhasil dibuat, silakan lakukan pembayaran.',
                'data'    => $donasi
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}