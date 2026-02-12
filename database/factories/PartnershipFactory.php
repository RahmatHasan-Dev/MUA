<?php

namespace Database\Factories;

use App\Models\Partnership;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnershipFactory extends Factory
{
    protected $model = Partnership::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->catchPhrase,
            'logo' => null,
            'website_url' => $this->faker->url,
            'kategori' => $this->faker->randomElement(['reguler', 'eksklusif', 'pengawasan']),
            'is_active' => true,
        ];
    }
}
