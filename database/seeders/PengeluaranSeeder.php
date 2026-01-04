<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{

public function run(): void
{
    $data = [
        // Pengiriman / Bensin
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Pengiriman',
            'nama_item' => 'Bensin',
            'keterangan' => 'Beat Hitam',
            'kuantitas' => 1,
            'harga_per_item' => 48000,
            'jumlah' => 48000,
        ],

        // Gaji Karyawan
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Mas Khafid',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 250000,
            'jumlah' => 250000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Alfian',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 100000,
            'jumlah' => 100000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Nanda',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Yanto',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Arya',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],

        // Nutrisi
        [
            'tanggal' => '2025-08-21',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Zona 1',
            'keterangan' => null,
            'kuantitas' => 15,
            'harga_per_item' => 14000,
            'jumlah' => 15 * 14000,
        ],
        [
            'tanggal' => '2025-08-21',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Zona 2',
            'keterangan' => null,
            'kuantitas' => 11.3,
            'harga_per_item' => 14000,
            'jumlah' => 11.3 * 14000,
        ],
    ];

    DB::table('transaksi_pengeluaran')->insert($data);
}




}

