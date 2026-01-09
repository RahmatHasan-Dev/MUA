<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonasiSuccessMail;

class PaymentCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Set konfigurasi midtrans
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

        // Ambil ID Donasi dari order_id (format: id_donasi-timestamp)
        $id_donasi = explode('-', $order_id)[0];
        $donasi = Donasi::find($id_donasi);

        if ($donasi) {
            if ($transaction == 'capture' || $transaction == 'settlement') {
                $donasi->update(['status' => 'berhasil']);
                // Kirim Email Notifikasi
                if ($donasi->user && $donasi->user->email) {
                    Mail::to($donasi->user->email)->send(new DonasiSuccessMail($donasi));
                }
            } elseif ($transaction == 'pending') {
                $donasi->update(['status' => 'pending']);
            } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $donasi->update(['status' => 'gagal']);
            }
        }

        return response()->json(['message' => 'Callback received']);
    }
}