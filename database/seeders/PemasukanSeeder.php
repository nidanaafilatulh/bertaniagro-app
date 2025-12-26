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
        ['pelanggan' => 'Syariah',              'produk' => 'Selada', 'kuantitas' => 20,  'harga' => 20000],
        ['pelanggan' => 'Oharang Lotte',        'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'Nasta',                'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'Gado gado',            'produk' => 'Selada', 'kuantitas' => 1,   'harga' => 20000],
        ['pelanggan' => 'Makan minum',          'produk' => 'Selada', 'kuantitas' => 1,   'harga' => 20000],
        ['pelanggan' => 'Nusantara Karangturi', 'produk' => 'Selada', 'kuantitas' => 3,   'harga' => 20000],
        ['pelanggan' => 'Pak Aji',              'produk' => 'Selada', 'kuantitas' => 3,   'harga' => 20000],
        ['pelanggan' => 'Pesta Kebun',          'produk' => 'Selada', 'kuantitas' => 2,   'harga' => 20000],
        ['pelanggan' => 'Bu Yamto',             'produk' => 'Selada', 'kuantitas' => 0.5, 'harga' => 26000],
        ['pelanggan' => 'Pengunjung',           'produk' => 'Selada', 'kuantitas' => 0.5, 'harga' => 26000],
        ['pelanggan' => 'SK Ngaliyan',          'produk' => 'Selada', 'kuantitas' => 2,   'harga' => 20000],
        ['pelanggan' => 'El kebab',             'produk' => 'Selada', 'kuantitas' => 5,   'harga' => 20000],
        ['pelanggan' => 'SK Pandansari',        'produk' => 'Selada', 'kuantitas' => 1,   'harga' => 20000],
        ['pelanggan' => 'Pengunjung',           'produk' => 'Selada', 'kuantitas' => 0.5, 'harga' => 26000],
    ];

    foreach ($data as $item) {

        $total = $item['kuantitas'] * $item['harga'];

        $transaksi = TransaksiPemasukan::create([
            'tanggal_transaksi' => '2025-09-30',
            'pelanggan'         => $item['pelanggan'],
            'jumlah'            => $total,
            'bukti_bayar'       => null,
        ]);

        ItemPemasukan::create([
            'no_transaksi' => $transaksi->no_transaksi,
            'produk'       => $item['produk'],
            'kuantitas'    => $item['kuantitas'],
            'satuan'       => 'Kg',
            'harga_satuan' => $item['harga'],
        ]);
    }
}




}
