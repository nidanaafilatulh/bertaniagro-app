<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiPemasukan;
use App\Models\ItemPemasukan;

class PemasukanSeeder extends Seeder
{
    public function run()
{
    $data = [
        ['pelanggan' => 'KB Mijen',              'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'KB Ngaliyan',           'produk' => 'Selada', 'kuantitas' => 4,   'harga' => 20000],
        ['pelanggan' => 'KB Kalipancur',         'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'KB Banjarsari',         'produk' => 'Selada', 'kuantitas' => 3,   'harga' => 20000],
        ['pelanggan' => 'KB Kedungmundu',        'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'Oharang Queen',         'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'JJ Steak',              'produk' => 'Selada', 'kuantitas' => 10,  'harga' => 20000],
        ['pelanggan' => 'Syariah',               'produk' => 'Selada', 'kuantitas' => 10,  'harga' => 20000],
        ['pelanggan' => 'Pak Aji',               'produk' => 'Selada', 'kuantitas' => 4,   'harga' => 20000],
        ['pelanggan' => 'Aneka sambal',          'produk' => 'Selada', 'kuantitas' => 1,   'harga' => 20000],
        ['pelanggan' => 'Veteran',               'produk' => 'Selada', 'kuantitas' => 4,   'harga' => 20000],
        ['pelanggan' => 'Mba hes',               'produk' => 'Selada', 'kuantitas' => 0.5, 'harga' => 26000],
        ['pelanggan' => 'Makan minum',           'produk' => 'Selada', 'kuantitas' => 2,   'harga' => 20000],
        ['pelanggan' => 'Tardy',                 'produk' => 'Selada', 'kuantitas' => 1,   'harga' => 20000],
        ['pelanggan' => 'Nusantara Karangturi',  'produk' => 'Selada', 'kuantitas' => 3,   'harga' => 20000],
        ['pelanggan' => 'Pengunjung',            'produk' => 'Selada', 'kuantitas' => 1,   'harga' => 20000],
        ['pelanggan' => 'Pengunjung',            'produk' => 'Selada', 'kuantitas' => 2,   'harga' => 20000],
        ['pelanggan' => 'Bu Yamto',              'produk' => 'Selada', 'kuantitas' => 2,   'harga' => 5000, 'satuan' => 'Pohon'],
    ];

    foreach ($data as $item) {

        $total = $item['kuantitas'] * $item['harga'];

        $transaksi = TransaksiPemasukan::create([
            'tanggal_transaksi' => '2025-09-11',
            'pelanggan'         => $item['pelanggan'],
            'jumlah'            => $total,
            'bukti_bayar'       => null,
        ]);

        ItemPemasukan::create([
            'no_transaksi' => $transaksi->no_transaksi,
            'produk'       => $item['produk'],
            'kuantitas'    => $item['kuantitas'],
            'satuan'       => $item['satuan'] ?? 'Kg',
            'harga_satuan' => $item['harga'],
        ]);
    }
}


}
