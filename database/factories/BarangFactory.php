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
    public function definition()
    {
        return [
            //
            'nama_barang' => fake()->unique()->name(),
            'harga_beli' => fake()->numberBetween(1000, 100000),
            'harga_jual' => fake()->numberBetween(1000, 100000),
            'stok' => fake()->numberBetween(1, 100),
            'foto_barang' => fake()->imageUrl(640, 480, 'cats', true, 'Faker'),
        ];
    }
}
