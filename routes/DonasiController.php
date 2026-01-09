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
            // 'id_user' => 'required|exists:pengguna,id', // Diganti dengan Auth user
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Tambahkan tanggal otomatis jika tidak ada
        $data = $request->all();
        if (!isset($data['tanggal'])) {
            $data['tanggal'] = now();
        }

        // Upload Bukti Transfer
        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
            $data['bukti_transfer'] = $path;
        }

        // Ambil ID User dari Token yang sedang login
        $data['id_user'] = $request->user()->id;
        
        // Set default status jika belum ada
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

    /**
     * Display the specified resource.
     * Method GET (Detail)
     */
    public function show(string $id)
    {
        $donasi = Donasi::find($id);

        if (!$donasi) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail data donasi ditemukan',
            'data' => $donasi
        ], 200);
    }
}