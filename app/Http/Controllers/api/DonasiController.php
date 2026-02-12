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
            'jenis'   => 'required|string',
            'nominal' => 'required|numeric|min:1000',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            // Ambil ID User dari Token (Lebih aman daripada input JSON)
            $user = $request->user();

            // Proses Upload Bukti Transfer
            if ($request->hasFile('bukti_transfer') && $request->file('bukti_transfer')->isValid()) {
                $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            } else {
                throw new \Exception("File bukti transfer tidak valid atau gagal diunggah.");
            }

            // 2. Simpan ke Database (Tabel Donasi)
            $donasi = Donasi::create([
                'id_user' => $user->id, // Otomatis dari token
                'jenis'   => $request->jenis,
                'nominal' => $request->nominal,
                'tanggal' => now(),
                'status'  => 'pending',
                'catatan' => 'Donasi via Mobile App',
                'bukti_transfer' => $path,
            ]);

            // 3. Berikan Respon Sukses (JSON)
            return response()->json([
                'status'  => true,
                'message' => 'Donasi berhasil dibuat dan bukti transfer terkirim. Mohon tunggu verifikasi admin.',
                'data'    => $donasi
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get detail of a donation.
     * Endpoint: GET /api/donasi/{id}
     */
    public function show($id, Request $request)
    {
        // Pastikan donasi milik user yang login
        $donasi = Donasi::where('id_donasi', $id)
                        ->where('id_user', $request->user()->id)
                        ->first();

        if (!$donasi) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $donasi
        ], 200);
    }

    /**
     * Get donation history by specific User ID.
     * Endpoint: GET /api/donasi/user/{id}
     */
    public function historyByUser($id)
    {
        // Ambil data donasi berdasarkan id_user yang dikirim di URL
        $donasi = Donasi::where('id_user', $id)
                        ->orderBy('tanggal', 'desc')
                        ->get();

        return response()->json([
            'status'  => true,
            'message' => 'Riwayat donasi user berhasil diambil',
            'count'   => $donasi->count(),
            'data'    => $donasi
        ], 200);
    }
}
