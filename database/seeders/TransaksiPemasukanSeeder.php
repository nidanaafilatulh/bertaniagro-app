<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiPemasukanSeeder extends Seeder
{
    public function run(): void
    {
        // Insert ke transaksi_pemasukan
        // Transaksi Aeon Mall - 11 September 2025
        $noTransaksiAeon11 = DB::table('transaksi_pemasukan')->insertGetId([
            'tanggal_transaksi' => '2025-09-11',
            'pelanggan' => 'Aeon Mall',
            'bukti_bayar' => null,
            'jumlah' => 66 * 9000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $itemsAeon11 = [
            ['produk' => 'Bayam Hijau', 'kuantitas' => 7],
            ['produk' => 'Bayam Merah', 'kuantitas' => 5],
            ['produk' => 'Caisim', 'kuantitas' => 5],
            ['produk' => 'Kale', 'kuantitas' => 5],
            ['produk' => 'Selada', 'kuantitas' => 15],
            ['produk' => 'Pakcoy', 'kuantitas' => 10],
            ['produk' => 'Kangkung', 'kuantitas' => 10],
            ['produk' => 'Romain', 'kuantitas' => 9],
        ];

        foreach ($itemsAeon11 as $item) {
            DB::table('item_pemasukan')->insert([
                'no_transaksi' => $noTransaksiAeon11,
                'produk' => $item['produk'],
                'kuantitas' => $item['kuantitas'],
                'satuan' => 'Pack',
                'harga_satuan' => 9000,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}