<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiPemasukanSeeder extends Seeder
{
    public function run(): void
{
    $harga = 9000;

    /*
    ============================================================
    ===================== 22 AGUSTUS 2025 ======================
    ======================= Aeon Mall ==========================
    ============================================================
    */

    $itemsAeon22 = [
        ['produk' => 'Selada', 'kuantitas' => 30], // 10 + 20
        ['produk' => 'Baby Pakcoy', 'kuantitas' => 20],
        ['produk' => 'Bayam', 'kuantitas' => 11],
        ['produk' => 'Bayam Merah', 'kuantitas' => 5],
        ['produk' => 'Caisim', 'kuantitas' => 15],
        ['produk' => 'Kangkung', 'kuantitas' => 40], // 20 + 20
        ['produk' => 'Pakcoy', 'kuantitas' => 20],
    ];

    $total22 = collect($itemsAeon22)->sum('kuantitas') * $harga;

    $aeon22 = DB::table('transaksi_pemasukan')->insertGetId([
        'tanggal_transaksi' => '2025-08-22',
        'pelanggan' => 'Aeon Mall',
        'bukti_bayar' => null,
        'jumlah' => $total22,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($itemsAeon22 as $item) {
        DB::table('item_pemasukan')->insert([
            'no_transaksi' => $aeon22,
            'produk' => $item['produk'],
            'kuantitas' => $item['kuantitas'],
            'satuan' => 'Pack',
            'harga_satuan' => $harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /*
    ===================== 23 AGUSTUS 2025 ======================
    */

    $itemsAeon23 = [
        ['produk' => 'Selada', 'kuantitas' => 20],
        ['produk' => 'Kangkung', 'kuantitas' => 20],
        ['produk' => 'Pakcoy', 'kuantitas' => 20],
        ['produk' => 'Caisim', 'kuantitas' => 20],
        ['produk' => 'Bayam', 'kuantitas' => 11],
    ];

    $total23 = collect($itemsAeon23)->sum('kuantitas') * $harga;

    $aeon23 = DB::table('transaksi_pemasukan')->insertGetId([
        'tanggal_transaksi' => '2025-08-23',
        'pelanggan' => 'Aeon Mall',
        'bukti_bayar' => null,
        'jumlah' => $total23,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($itemsAeon23 as $item) {
        DB::table('item_pemasukan')->insert([
            'no_transaksi' => $aeon23,
            'produk' => $item['produk'],
            'kuantitas' => $item['kuantitas'],
            'satuan' => 'Pack',
            'harga_satuan' => $harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /*
    ===================== 25 AGUSTUS 2025 ======================
    */

    $itemsAeon25 = [
        ['produk' => 'Kangkung', 'kuantitas' => 20],
        ['produk' => 'Selada', 'kuantitas' => 20],
        ['produk' => 'Bayam', 'kuantitas' => 14],
        ['produk' => 'Bayam Merah', 'kuantitas' => 7],
        ['produk' => 'Pakcoy', 'kuantitas' => 9],
        ['produk' => 'Baby Pakcoy', 'kuantitas' => 6],
        ['produk' => 'Caisim', 'kuantitas' => 20],
    ];

    $total25 = collect($itemsAeon25)->sum('kuantitas') * $harga;

    $aeon25 = DB::table('transaksi_pemasukan')->insertGetId([
        'tanggal_transaksi' => '2025-08-25',
        'pelanggan' => 'Aeon Mall',
        'bukti_bayar' => null,
        'jumlah' => $total25,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($itemsAeon25 as $item) {
        DB::table('item_pemasukan')->insert([
            'no_transaksi' => $aeon25,
            'produk' => $item['produk'],
            'kuantitas' => $item['kuantitas'],
            'satuan' => 'Pack',
            'harga_satuan' => $harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /*
    ===================== 27 AGUSTUS 2025 ======================
    */

    // PENGUNJUNG
    $itemsPengunjung27 = [
        ['produk' => 'Selada', 'kuantitas' => 0.5, 'satuan' => 'Kg'],
        ['produk' => 'Kangkung', 'kuantitas' => 2, 'satuan' => 'Pack'],
    ];

    $totalPengunjung27 = collect($itemsPengunjung27)->sum('kuantitas') * $harga;

    $pengunjung27 = DB::table('transaksi_pemasukan')->insertGetId([
        'tanggal_transaksi' => '2025-08-27',
        'pelanggan' => 'Pengunjung',
        'bukti_bayar' => null,
        'jumlah' => $totalPengunjung27,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($itemsPengunjung27 as $item) {
        DB::table('item_pemasukan')->insert([
            'no_transaksi' => $pengunjung27,
            'produk' => $item['produk'],
            'kuantitas' => $item['kuantitas'],
            'satuan' => $item['satuan'],
            'harga_satuan' => $harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /*
============================================================
==================== 27 AGUSTUS 2025 =======================
============================================================
*/

$harga = 9000;

/*
==================== BU BRINA =====================
*/

$itemsBuBrina27 = [
    ['produk' => 'Selada', 'kuantitas' => 4],
    ['produk' => 'Pakcoy', 'kuantitas' => 2],
];

$totalBuBrina27 = collect($itemsBuBrina27)->sum('kuantitas') * $harga;

$buBrina27 = DB::table('transaksi_pemasukan')->insertGetId([
    'tanggal_transaksi' => '2025-08-27',
    'pelanggan' => 'Bu Brina',
    'bukti_bayar' => null,
    'jumlah' => $totalBuBrina27,
    'created_at' => now(),
    'updated_at' => now(),
]);

foreach ($itemsBuBrina27 as $item) {
    DB::table('item_pemasukan')->insert([
        'no_transaksi' => $buBrina27,
        'produk' => $item['produk'],
        'kuantitas' => $item['kuantitas'],
        'satuan' => 'Pack',
        'harga_satuan' => $harga,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


/*
==================== AEON MALL =====================
*/

$itemsAeon27 = [
    ['produk' => 'Selada', 'kuantitas' => 5],
    ['produk' => 'Kangkung', 'kuantitas' => 5],
    ['produk' => 'Kailan', 'kuantitas' => 5],
];

$totalAeon27 = collect($itemsAeon27)->sum('kuantitas') * $harga;

$aeon27 = DB::table('transaksi_pemasukan')->insertGetId([
    'tanggal_transaksi' => '2025-08-27',
    'pelanggan' => 'AEON MALL',
    'bukti_bayar' => null,
    'jumlah' => $totalAeon27,
    'created_at' => now(),
    'updated_at' => now(),
]);

foreach ($itemsAeon27 as $item) {
    DB::table('item_pemasukan')->insert([
        'no_transaksi' => $aeon27,
        'produk' => $item['produk'],
        'kuantitas' => $item['kuantitas'],
        'satuan' => 'Pack',
        'harga_satuan' => $harga,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}


/*
==================== ISTANA BUAH =====================
*/

$itemsIstanaBuah27 = [
    ['produk' => 'Selada', 'kuantitas' => 30],
    ['produk' => 'Caisim', 'kuantitas' => 45],
    ['produk' => 'Kailan', 'kuantitas' => 15],
];

$totalIstanaBuah27 = collect($itemsIstanaBuah27)->sum('kuantitas') * $harga;

$istanaBuah27 = DB::table('transaksi_pemasukan')->insertGetId([
    'tanggal_transaksi' => '2025-08-27',
    'pelanggan' => 'Istana Buah',
    'bukti_bayar' => null,
    'jumlah' => $totalIstanaBuah27,
    'created_at' => now(),
    'updated_at' => now(),
]);

foreach ($itemsIstanaBuah27 as $item) {
    DB::table('item_pemasukan')->insert([
        'no_transaksi' => $istanaBuah27,
        'produk' => $item['produk'],
        'kuantitas' => $item['kuantitas'],
        'satuan' => 'Pack',
        'harga_satuan' => $harga,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

    /*
    ===================== 29 AGUSTUS 2025 ======================
    */

    $itemsAeon29 = [
        ['produk' => 'Selada', 'kuantitas' => 10],
        ['produk' => 'Bayam Hijau', 'kuantitas' => 10],
        ['produk' => 'Bayam Merah', 'kuantitas' => 5],
        ['produk' => 'Kailan', 'kuantitas' => 5],
        ['produk' => 'Romain', 'kuantitas' => 5],
        ['produk' => 'Kale', 'kuantitas' => 5],
        ['produk' => 'Caisim', 'kuantitas' => 5],
        ['produk' => 'Pakcoy Putih', 'kuantitas' => 10],
    ];

    $total29 = collect($itemsAeon29)->sum('kuantitas') * $harga;

    $aeon29 = DB::table('transaksi_pemasukan')->insertGetId([
        'tanggal_transaksi' => '2025-08-29',
        'pelanggan' => 'Aeon Mall',
        'bukti_bayar' => null,
        'jumlah' => $total29,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($itemsAeon29 as $item) {
        DB::table('item_pemasukan')->insert([
            'no_transaksi' => $aeon29,
            'produk' => $item['produk'],
            'kuantitas' => $item['kuantitas'],
            'satuan' => 'Pack',
            'harga_satuan' => $harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    /*
    ===================== 30 AGUSTUS 2025 ======================
    */

    $itemsAeon30 = [
        ['produk' => 'Selada', 'kuantitas' => 15],
        ['produk' => 'Baby Pakcoy', 'kuantitas' => 14],
        ['produk' => 'Kale', 'kuantitas' => 5],
        ['produk' => 'Caisim', 'kuantitas' => 5],
        ['produk' => 'Romain', 'kuantitas' => 5],
        ['produk' => 'Pakcoy', 'kuantitas' => 20],
        ['produk' => 'Pakcoy Putih', 'kuantitas' => 10],
        ['produk' => 'Bayam Merah', 'kuantitas' => 10],
    ];

    $total30 = collect($itemsAeon30)->sum('kuantitas') * $harga;

    $aeon30 = DB::table('transaksi_pemasukan')->insertGetId([
        'tanggal_transaksi' => '2025-08-30',
        'pelanggan' => 'Aeon Mall',
        'bukti_bayar' => null,
        'jumlah' => $total30,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    foreach ($itemsAeon30 as $item) {
        DB::table('item_pemasukan')->insert([
            'no_transaksi' => $aeon30,
            'produk' => $item['produk'],
            'kuantitas' => $item['kuantitas'],
            'satuan' => 'Pack',
            'harga_satuan' => $harga,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}






    
}