<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user dengan ID 1 sudah ada
        $exists = DB::table('pengguna')->where('id', 1)->exists();

        if (!$exists) {
            DB::table('pengguna')->insert([
                'id' => 1,
                'nama' => 'User Test Postman',
                'email' => 'test@mua.com',
                'password' => Hash::make('password123'), // Password untuk login
                'no_hp' => '081234567890',
                'tgl_lahir' => '2000-01-01',
            ]);
        }
    }
}