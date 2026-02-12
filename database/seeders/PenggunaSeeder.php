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
        // 1. Buat Akun Admin (Untuk Login Dashboard)
        // Cek dulu biar tidak duplikat berdasarkan email
        if (!DB::table('pengguna')->where('email', 'admin@mua.com')->exists()) {
            DB::table('pengguna')->insert([
                'nama' => 'Administrator MUA',
                'email' => 'admin@mua.com',
                'password' => Hash::make('admin123'), // Password login: admin123
                'no_hp' => '081299998888',
                'tgl_lahir' => '1995-08-17',
                'role' => 'admin', // PENTING: Role set ke admin
            ]);
            $this->command->info('Akun Admin berhasil dibuat: admin@mua.com | Pass: admin123');
        }

        // 2. Buat Akun User Biasa (Untuk Testing Login User)
        if (!DB::table('pengguna')->where('email', 'user1@gmail.com')->exists()) {
            DB::table('pengguna')->insert([
                'nama' => 'User Dermawan',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('user123'), // Password: user123
                'no_hp' => '081233334444',
                'tgl_lahir' => '2000-01-01',
                'role' => 'user',
            ]);
        }

        // 3. Update user yang sudah ada agar punya role 'user' (jika role masih kosong/NULL)
        // Ini opsional, untuk merapikan data lama
        DB::table('pengguna')->whereNull('role')->update(['role' => 'user']);

        // 4. Generate Data Dummy (20 User Tambahan)
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 20; $i++) {
            DB::table('pengguna')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Default password
                'no_hp' => $faker->phoneNumber,
                'tgl_lahir' => $faker->date('Y-m-d', '2005-01-01'),
                'role' => 'user',
                'is_active' => $faker->boolean(80), // 80% kemungkinan aktif
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}