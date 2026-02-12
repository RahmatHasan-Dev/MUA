<?php

namespace Database\Factories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(4),
            'deskripsi' => $this->faker->paragraph(3),
            'gambar' => null, // Gunakan default di view jika null
            'target' => $this->faker->numberBetween(10, 500) * 1000000, // 10jt - 500jt
        ];
    }
}
