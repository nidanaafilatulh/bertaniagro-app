<?php

namespace Database\Factories;

use App\Models\Pemasukan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemPemasukan>
 */
class ItemPemasukanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
    {
        return [
            // Create a transaksi first, then use its no_transaksi
            'no_transaksi' => $this->faker->numberBetween(1, 10),
            'produk'        => $this->faker->randomElement(['selada', 'sawi_bakso', 'seledri']),
            'kuantitas'     => $this->faker->numberBetween(1, 10),
            'satuan'        => $this->faker->randomElement(['pcs', 'kg']),
            'harga_satuan'  => $this->faker->randomElement([25000, 15000, 10000]),
        ];
    }
}
