<?php

namespace Database\Factories;

use App\Models\Donasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonasiFactory extends Factory
{
    protected $model = Donasi::class;

    public function definition(): array
    {
        return [
            // Ambil user acak dari database, atau buat baru jika kosong
            'id_user' => User::inRandomOrder()->first()->id ?? User::factory(),
            
            // Pilih jenis program secara acak
            'jenis' => $this->faker->randomElement(['satwa', 'karang', 'bakau']),
            
            // Nominal acak kelipatan 50.000 (biar terlihat realistis)
            'nominal' => $this->faker->numberBetween(1, 20) * 50000,
            
            // Tanggal acak dalam 12 bulan terakhir (PENTING UNTUK GRAFIK)
            'tanggal' => $this->faker->dateTimeBetween('-12 months', 'now'),
            
            // Status acak dengan pembobotan (lebih banyak berhasil daripada gagal)
            'status' => $this->faker->randomElement(['berhasil', 'berhasil', 'berhasil', 'pending', 'gagal']),
            
            'bukti_transfer' => null, // Kosongkan dulu untuk dummy
        ];
    }
}