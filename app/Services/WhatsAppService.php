<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function send($phone, $message)
    {
        // Simulasi pengiriman pesan (Log ke file laravel.log)
        // Anda bisa mengganti ini dengan integrasi API WhatsApp (misal: Twilio, Fonnte, Wablas)
        Log::info("WhatsApp Service: Mengirim pesan ke {$phone}");
        Log::info("Isi Pesan: {$message}");

        return true;
    }
}