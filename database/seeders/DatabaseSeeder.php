<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pastikan UserSeeder dijalankan dulu jika tabel users/pengguna masih kosong
        // \App\Models\User::factory(10)->create();

        $this->call([
            DonasiSeeder::class,
        ]);
    }
}