<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        static $increment = 1;
        return [
            'kode_barang' => $this->faker->unique()->randomNumber(8),
            // increment number from 1 to 1000
            'nama_barang' => 'Barang ' . $increment++,
            'stok_barang' => $this->faker->randomNumber(3),
            'status_barang' => $this->faker->randomElement(['TERSEDIA', 'HABIS', 'RUSAK', 'HILANG']),
            'gambar_barang' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
        ];
    }
}
