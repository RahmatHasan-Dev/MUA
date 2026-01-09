<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-xxxx'), // Ganti dengan Server Key Sandbox/Production Anda
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-xxxx'), // Ganti dengan Client Key Anda
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => true,
    'is_3ds' => true,
];