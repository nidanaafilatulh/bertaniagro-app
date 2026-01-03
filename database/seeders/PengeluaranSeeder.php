<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{

public function run(): void
{
    $data = [
        // Pengiriman
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Pengiriman',
            'nama_item' => 'Bensin',
            'keterangan' => 'Beat Hitam',
            'kuantitas' => 1,
            'harga_per_item' => 30000,
            'jumlah' => 30000,
        ],

        // Gaji Karyawan
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Mas Khafid',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 250000,
            'jumlah' => 250000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Disma',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 130000,
            'jumlah' => 130000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Alfian',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 100000,
            'jumlah' => 100000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Yanto',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Arya',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Tukang',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 260000,
            'jumlah' => 260000,
        ],

        // Nutrisi
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Zona 1',
            'keterangan' => null,
            'kuantitas' => 13,
            'harga_per_item' => 14000,
            'jumlah' => 13 * 14000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Zona 2',
            'keterangan' => null,
            'kuantitas' => 5,
            'harga_per_item' => 14000,
            'jumlah' => 5 * 14000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Zona 3',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 14000,
            'jumlah' => 1 * 14000,
        ],

        // Operasional
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Lain lain',
            'nama_item' => 'Mantel Plastik',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 10000,
            'jumlah' => 10000,
        ],
        [
            'tanggal' => '2025-09-10',
            'jenis_pengeluaran' => 'Lain lain',
            'nama_item' => 'Ongkos Bongkar Baja Ringan',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 20000,
            'jumlah' => 20000,
        ],
    ];

    DB::table('transaksi_pengeluaran')->insert($data);
}


}

