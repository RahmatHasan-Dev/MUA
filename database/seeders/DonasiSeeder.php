<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Donasi;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 150 data transaksi donasi palsu
        // Data ini akan tersebar dalam 1 tahun terakhir
        // sehingga grafik di dashboard akan terlihat penuh.
        Donasi::factory()->count(150)->create();
    }
}