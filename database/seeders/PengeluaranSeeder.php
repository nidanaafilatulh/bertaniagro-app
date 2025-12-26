<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
{
    $data = [
        // Gaji
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Pengiriman',
            'nama_item' => 'Bensin',
            'keterangan' => 'Bensin Beat Hitam',
            'kuantitas' => 1,
            'harga_per_item' => 48000,
            'jumlah' => 1 * 48000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Gaji Mas Khafid',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 250000,
            'jumlah' => 250000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Gaji Alfian',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 100000,
            'jumlah' => 100000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Gaji Nanda',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Gaji Yanto',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Gaji Karyawan',
            'nama_item' => 'Gaji Arya',
            'keterangan' => null,
            'kuantitas' => 1,
            'harga_per_item' => 80000,
            'jumlah' => 80000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Nutrisi Zona 1',
            'keterangan' => null,
            'kuantitas' => 15,
            'harga_per_item' => 14000,
            'jumlah' => 15 * 14000,
        ],
        [
            'tanggal' => '2025-09-21',
            'jenis_pengeluaran' => 'Nutrisi',
            'nama_item' => 'Nutrisi Zona 2',
            'keterangan' => null,
            'kuantitas' => 11.3,
            'harga_per_item' => 14000,
            'jumlah' => 11.3 * 14000,
        ],
        
    ];

    DB::table('transaksi_pengeluaran')->insert($data);
}


}


// [
//             'tanggal' => '2025-09-17',
//             'jenis_pengeluaran' => 'Benih',
//             'nama_item' => 'Benih Pakcoy',
//             'keterangan' => null,
//             'kuantitas' => 1,
//             'harga_per_item' => 20000,
//             'jumlah' => 1 * 20000,
//         ],
//         [
//             'tanggal' => '2025-09-17',
//             'jenis_pengeluaran' => 'Benih',
//             'nama_item' => 'Benih Fino',
//             'keterangan' => null,
//             'kuantitas' => 1,
//             'harga_per_item' => 30000,
//             'jumlah' => 1 * 30000,
//         ],
//         [
//             'tanggal' => '2025-09-17',
//             'jenis_pengeluaran' => 'Pengiriman',
//             'nama_item' => 'Parkir dan e tol',
//             'keterangan' => 'Parkir',
//             'kuantitas' => 1,
//             'harga_per_item' => 2000,
//             'jumlah' => 1 * 2000,
//         ],

// [
//             'tanggal' => '2025-09-17',
//             'jenis_pengeluaran' => 'Pengiriman',
//             'nama_item' => 'Service',
//             'keterangan' => 'Service Beat Putih',
//             'kuantitas' => 1,
//             'harga_per_item' => 30000,
//             'jumlah' => 1 * 30000,
//         ],



// [
//             'tanggal' => '2025-09-17',
//             'jenis_pengeluaran' => 'Listrik',
//             'nama_item' => 'Kebun 2',
//             'keterangan' => null,
//             'kuantitas' => 1,
//             'harga_per_item' => 203000,
//             'jumlah' => 1 * 203000,
//         ],


// [
//             'tanggal' => '2025-09-16',
//             'jenis_pengeluaran' => 'Kemasan',
//             'nama_item' => 'Plastik Zebra',
//             'keterangan' => null,
//             'kuantitas' => 2,
//             'harga_per_item' => 8000,
//             'jumlah' => 2 * 8000,
//         ],