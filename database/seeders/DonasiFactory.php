<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donasi>
 */
class DonasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::inRandomOrder()->first()->id ?? 1, // Ambil user acak yang ada
            'jenis' => $this->faker->randomElement(['satwa', 'karang', 'bakau', 'pendidikan']),
            'nominal' => $this->faker->numberBetween(10000, 5000000),
            'status' => $this->faker->randomElement(['pending', 'berhasil', 'gagal']),
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'catatan' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}