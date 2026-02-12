<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Operasional', 'Program', 'Gaji', 'Peralatan', 'Lainnya'];
        $data = [];

        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'judul' => 'Pengeluaran Operasional ke-' . $i,
                'nominal' => rand(100000, 5000000),
                'tanggal' => Carbon::now()->subDays(rand(0, 60))->format('Y-m-d'),
                'kategori' => $kategori[array_rand($kategori)],
                'bukti' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pengeluaran')->insert($data);
    }
}