<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Donasi;
use App\Models\Berita;
use App\Models\Partnership;
use App\Models\Pengeluaran;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Seeder Terpisah (Struktur Rapi & Modular)
        |--------------------------------------------------------------------------
        */
        $this->call([
            PenggunaSeeder::class,     // Akun admin & user utama
            CampaignSeeder::class,
            DonasiSeeder::class,
            PengeluaranSeeder::class,
            PartnershipSeeder::class,
            VisiMisiSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. Dummy Data (Factory)
        |--------------------------------------------------------------------------
        */

        // User tambahan
        User::factory(50)->create();

        // Campaign
        Campaign::factory(10)->create();

        // Donasi (pastikan user & campaign sudah ada)
        Donasi::factory(300)->create();

        // Berita / Kegiatan
        Berita::factory(20)->create();

        // Partnership
        Partnership::factory(15)->create();

        // Pengeluaran
        Pengeluaran::factory(50)->create();

        /*
        |--------------------------------------------------------------------------
        | Seeder tambahan jika diperlukan
        |--------------------------------------------------------------------------
        */
        // $this->call(FunFactSeeder::class);
    }
}
