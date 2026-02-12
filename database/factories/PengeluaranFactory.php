<?php

namespace Database\Factories;

use App\Models\Pengeluaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengeluaranFactory extends Factory
{
    protected $model = Pengeluaran::class;

    public function definition(): array
    {
        static $number = 1;
        return [
            'no_transaksi' => 'OUT-' . str_pad($number++, 5, '0', STR_PAD_LEFT),
            'judul' => 'Pembayaran ' . $this->faker->words(3, true),
            'nominal' => $this->faker->numberBetween(1, 50) * 100000,
            'tanggal' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'kategori' => $this->faker->randomElement(['Operasional', 'Program', 'Gaji', 'Logistik']),
            'keterangan' => $this->faker->sentence,
        ];
    }
}
