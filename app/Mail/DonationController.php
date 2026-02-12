<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string',
            'nominal' => 'required|numeric|min:1',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_transfer')) {
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
        }

        // Logika: Jika login pakai ID user, jika tidak pakai ID 1 (Guest/Test User)
        $userId = Auth::check() ? Auth::id() : 1;
        $userName = Auth::check() ? Auth::user()->nama : 'Guest / Donatur Tamu';
        $userEmail = Auth::check() ? Auth::user()->email : 'guest@mua.com';
        $userPhone = Auth::check() ? Auth::user()->no_hp : '081234567890';

        $donasi = Donasi::create([
            'id_user' => $userId,
            'jenis' => $request->input('jenis'),
            'nominal' => $request->input('nominal'),
            'tanggal' => now(),
            'status' => 'berhasil', // Diganti sukses (hijau) sesuai permintaan
            'bukti_transfer' => $path,
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat Parameter Transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $donasi->id_donasi . '-' . time(), // Order ID unik
                'gross_amount' => (int) $donasi->nominal,
            ],
            'customer_details' => [
                'first_name' => $userName,
                'email' => $userEmail,
                'phone' => $userPhone,
            ],
        ];

        try {
            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);
            
            $donasi->snap_token = $snapToken;
            $donasi->save();

            return redirect()->route('donasi')->with('success', 'Donasi dibuat! Silakan selesaikan pembayaran.')->with('snap_token', $snapToken);
        } catch (\Exception $e) {
            // Jangan logout user jika error, kembalikan ke form dengan pesan
            return redirect()->route('donasi')->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }
}