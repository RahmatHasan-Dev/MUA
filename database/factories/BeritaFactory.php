<?php

namespace Database\Factories;

use App\Models\Berita;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeritaFactory extends Factory
{
    protected $model = Berita::class;

    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(6),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'gambar' => null,
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'lokasi' => $this->faker->city,
            'peserta' => $this->faker->numberBetween(10, 200) . ' Orang',
            'tag1' => $this->faker->word,
            'tag2' => $this->faker->word,
            'tag3' => $this->faker->word,
        ];
    }
}
