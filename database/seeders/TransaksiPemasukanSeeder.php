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
       // ================= AEON MALL (29-09-2025) =================
$aeon29 = DB::table('transaksi_pemasukan')->insertGetId([
    'tanggal_transaksi' => '2025-09-29',
    'pelanggan' => 'AEON MALL',
    'bukti_bayar' => null,
    'jumlah' => 378000,
    'created_at' => now(),
    'updated_at' => now(),
]);

$itemsAeon29 = [
    ['produk' => 'Caisim', 'kuantitas' => 4],
    ['produk' => 'Baby Pakcoy', 'kuantitas' => 8],
    ['produk' => 'Bayam Merah', 'kuantitas' => 3],
    ['produk' => 'Kailan', 'kuantitas' => 4],
    ['produk' => 'Kale', 'kuantitas' => 4],
    ['produk' => 'Pagoda', 'kuantitas' => 4],
    ['produk' => 'Pakcoy Putih', 'kuantitas' => 4],
    ['produk' => 'Romain', 'kuantitas' => 4],
    ['produk' => 'Selada', 'kuantitas' => 7],
];

foreach ($itemsAeon29 as $item) {
    DB::table('item_pemasukan')->insert([
        'no_transaksi' => $aeon29,
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