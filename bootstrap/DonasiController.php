<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * Method GET
     */
    public function index()
    {
        $donasi = Donasi::all();
        return response()->json([
            'status' => true,
            'message' => 'Data donasi berhasil diambil',
            'data' => $donasi
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * Method POST
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string',
            'nominal' => 'required|numeric|min:1',
            'id_user' => 'required|exists:pengguna,id', // Pastikan user ada di tabel pengguna
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Siapkan data
        $data = $request->all();
        
        // Tambahkan tanggal otomatis jika tidak ada
        if (!isset($data['tanggal'])) {
            $data['tanggal'] = now();
        }

        // Default status pending jika tidak ada
        if (!isset($data['status'])) {
            $data['status'] = 'pending';
        }

        $donasi = Donasi::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Data donasi berhasil ditambahkan',
            'data' => $donasi
        ], 201);
    }

    public function show($id)
    {
        $donasi = Donasi::find($id);
        if (!$donasi) return response()->json(['message' => 'Data tidak ditemukan'], 404);
        return response()->json(['data' => $donasi], 200);
    }
}