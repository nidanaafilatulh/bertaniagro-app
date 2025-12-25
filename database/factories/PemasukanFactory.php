<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiPemasukan>
 */
class PemasukanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_transaksi' => $this->faker->dateTimeBetween('2025-11-01', '2025-11-31')->format('Y-m-d'),
            'pelanggan' => $this->faker->name(),
            'jumlah' => $this->faker->numberBetween(50, 500) * 1000,
        ];
    }
}
