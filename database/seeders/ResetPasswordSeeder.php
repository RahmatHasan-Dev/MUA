<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordSeeder extends Seeder
{
    public function run()
    {
        // Reset semua password di tabel pengguna menjadi 'password123'
        DB::table('pengguna')->update([
            'password' => Hash::make('password123')
        ]);
        
        $this->command->info('Semua password user berhasil direset menjadi: password123');
    }
}