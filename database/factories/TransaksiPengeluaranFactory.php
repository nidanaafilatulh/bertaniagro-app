<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiPengeluaran>
 */
class TransaksiPengeluaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kuantitas = $this->faker->numberBetween(1, 10);
        $harga = $this->faker->numberBetween(50, 500) * 1000;

        return [
            'tanggal' => $this->faker->dateTimeBetween('2025-11-01', '2025-11-31')->format('Y-m-d'),
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => $this->faker->randomElement(['Gaji Rama', 'Gaji Alfian', 'Gaji Rendi', 'Gaji Mas Khafid', 'Gaji Pak Joko']),
            'kuantitas' => $kuantitas,
            'harga_per_item' => $harga,
            'jumlah' => $kuantitas * $harga,
        ];
    }
}
