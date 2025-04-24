<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->words(2, true), // contoh: "Keyboard Logitech"
            'deskripsi' => $this->faker->sentence(12), // deskripsi pendek
            'stock' => $this->faker->numberBetween(1, 20),
        ];
    }
}
