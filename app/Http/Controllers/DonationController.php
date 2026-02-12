<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Campaign;
use App\Models\User; // Import User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification; // Tambahkan ini
use Illuminate\Support\Facades\Mail; // Import Mail
use App\Mail\AdminDonationNotification; // Import Mailable Admin
use Illuminate\Support\Facades\Log; // Import Log

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

        // Cek apakah Server Key sudah diatur
        // Jika key kosong atau masih placeholder, langsung bypass ke halaman sukses (Mode Simulasi)
        if (empty(Config::$serverKey) || Config::$serverKey == 'SB-Mid-server-xxxx' || Config::$serverKey == 'SB-Mid-server-GANTI_KEY_INI') {
            // Kembali ke halaman donasi dengan trigger modal sukses
            return redirect()->route('donasi')->with('show_success_modal', true)->with('donasi_id', $donasi->id_donasi);
        }

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

    public function notificationCallback(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid notification'], 400);
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        // ID Donasi format: ID-TIMESTAMP (Contoh: 15-1700000000)
        // Kita ambil ID depannya saja
        $donasi_id = explode('-', $order_id)[0];
        $donasi = Donasi::where('id_donasi', $donasi_id)->first();

        if (!$donasi) {
            return response()->json(['message' => 'Donation not found'], 404);
        }

        // Simpan status lama untuk pengecekan perubahan
        $statusAwal = $donasi->status;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $donasi->update(['status' => 'pending']);
                } else {
                    $donasi->update(['status' => 'berhasil']);
                }
            }
        } else if ($transaction == 'settlement') {
            $donasi->update(['status' => 'berhasil']);
        } else if ($transaction == 'pending') {
            $donasi->update(['status' => 'pending']);
        } else if ($transaction == 'deny') {
            $donasi->update(['status' => 'gagal']);
        } else if ($transaction == 'expire') {
            $donasi->update(['status' => 'gagal']);
        } else if ($transaction == 'cancel') {
            $donasi->update(['status' => 'gagal']);
        }

        // Cek apakah status berubah menjadi 'berhasil' dari yang sebelumnya bukan 'berhasil'
        // Ini untuk mencegah spam email jika Midtrans mengirim notifikasi berulang
        if ($statusAwal !== 'berhasil' && $donasi->fresh()->status == 'berhasil') {
            $this->notifyAdmin($donasi);
        }

        return response()->json(['message' => 'Payment status updated']);
    }

    protected function notifyAdmin($donasi)
    {
        // Ambil email admin pertama dari database
        $admin = User::where('role', 'admin')->first();
        
        if ($admin && $admin->email) {
            try {
                Mail::to($admin->email)->queue(new AdminDonationNotification($donasi));
            } catch (\Exception $e) {
                Log::error('Gagal mengirim notifikasi admin: ' . $e->getMessage());
            }
        }
    }
}