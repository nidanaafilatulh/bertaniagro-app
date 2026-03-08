<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{

public function run(): void
{
    $data = [
        // =======================
// 01 Agustus 2025
// =======================
[
    'tanggal' => '2025-08-01',
    'jenis_pengeluaran' => 'Listrik',
    'nama_item' => 'Kebun 1',
    'keterangan' => null,
    'kuantitas' => 1,
    'harga_per_item' => 203500,
    'jumlah' => 1 * 203500,
],
[
    'tanggal' => '2025-08-01',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 1',
    'keterangan' => null,
    'kuantitas' => 5,
    'harga_per_item' => 14000,
    'jumlah' => 5 * 14000,
],
[
    'tanggal' => '2025-08-01',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 3',
    'keterangan' => null,
    'kuantitas' => 8,
    'harga_per_item' => 14000,
    'jumlah' => 8 * 14000,
],


// =======================
// 02 Agustus 2025
// =======================
[
    'tanggal' => '2025-08-02',
    'jenis_pengeluaran' => 'Listrik',
    'nama_item' => 'Kebun 2',
    'keterangan' => null,
    'kuantitas' => 1,
    'harga_per_item' => 203500,
    'jumlah' => 1 * 203500,
],
[
    'tanggal' => '2025-08-02',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 1',
    'keterangan' => null,
    'kuantitas' => 5.5,
    'harga_per_item' => 14000,
    'jumlah' => 5.5 * 14000,
],
[
    'tanggal' => '2025-08-02',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 2',
    'keterangan' => null,
    'kuantitas' => 9,
    'harga_per_item' => 14000,
    'jumlah' => 9 * 14000,
],
[
    'tanggal' => '2025-08-02',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 3',
    'keterangan' => null,
    'kuantitas' => 18,
    'harga_per_item' => 14000,
    'jumlah' => 18 * 14000,
],
[
    'tanggal' => '2025-08-02',
    'jenis_pengeluaran' => 'Pestisida',
    'nama_item' => 'Pesnab',
    'keterangan' => null,
    'kuantitas' => 0.35,
    'harga_per_item' => 50000,
    'jumlah' => 0.35 * 50000,
],


// =======================
// 03 Agustus 2025
// =======================
[
    'tanggal' => '2025-08-03',
    'jenis_pengeluaran' => 'Administrasi',
    'nama_item' => 'Nota',
    'keterangan' => null,
    'kuantitas' => 1,
    'harga_per_item' => 8000,
    'jumlah' => 1 * 8000,
],
[
    'tanggal' => '2025-08-03',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 1',
    'keterangan' => null,
    'kuantitas' => 7.5,
    'harga_per_item' => 14000,
    'jumlah' => 7.5 * 14000,
],
[
    'tanggal' => '2025-08-03',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 2',
    'keterangan' => null,
    'kuantitas' => 3,
    'harga_per_item' => 14000,
    'jumlah' => 3 * 14000,
],
[
    'tanggal' => '2025-08-03',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 3',
    'keterangan' => null,
    'kuantitas' => 8,
    'harga_per_item' => 14000,
    'jumlah' => 8 * 14000,
],
[
    'tanggal' => '2025-08-03',
    'jenis_pengeluaran' => 'Pestisida',
    'nama_item' => 'Pesnab',
    'keterangan' => null,
    'kuantitas' => 0.5,
    'harga_per_item' => 50000,
    'jumlah' => 0.5 * 50000,
],
[
    'tanggal' => '2025-08-03',
    'jenis_pengeluaran' => 'Kulakan',
    'nama_item' => 'Selada',
    'keterangan' => null,
    'kuantitas' => 90,
    'harga_per_item' => 15000,
    'jumlah' => 90 * 15000,
],


// =======================
// 04 Agustus 2025
// =======================
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 2',
    'keterangan' => null,
    'kuantitas' => 1,
    'harga_per_item' => 14000,
    'jumlah' => 1 * 14000,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Benih',
    'nama_item' => 'Selada Sonybel',
    'keterangan' => null,
    'kuantitas' => 5,
    'harga_per_item' => 70000,
    'jumlah' => 5 * 70000,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Benih',
    'nama_item' => 'Selada Junction',
    'keterangan' => null,
    'kuantitas' => 768,
    'harga_per_item' => 280,
    'jumlah' => 768 * 280,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Rockwool',
    'nama_item' => 'Rockwool',
    'keterangan' => null,
    'kuantitas' => 2.4,
    'harga_per_item' => 70000,
    'jumlah' => 2.4 * 70000,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Pestisida',
    'nama_item' => 'Pesnab',
    'keterangan' => null,
    'kuantitas' => 0.5,
    'harga_per_item' => 50000,
    'jumlah' => 0.5 * 50000,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'H202',
    'nama_item' => 'H2O2',
    'keterangan' => null,
    'kuantitas' => 5,
    'harga_per_item' => 20000,
    'jumlah' => 5 * 20000,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Benih',
    'nama_item' => 'Selada Sonybel',
    'keterangan' => 'Kebun 1',
    'kuantitas' => 0.75,
    'harga_per_item' => 70000,
    'jumlah' => 0.75 * 70000,
],
[
    'tanggal' => '2025-08-04',
    'jenis_pengeluaran' => 'Rockwool',
    'nama_item' => 'Rockwool',
    'keterangan' => 'Kebun 1',
    'kuantitas' => 1.5,
    'harga_per_item' => 70000,
    'jumlah' => 1.5 * 70000,
],


// =======================
// 05 Agustus 2025
// =======================
[
    'tanggal' => '2025-08-05',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 1',
    'keterangan' => null,
    'kuantitas' => 26,
    'harga_per_item' => 14000,
    'jumlah' => 26 * 14000,
],
[
    'tanggal' => '2025-08-05',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 2',
    'keterangan' => null,
    'kuantitas' => 2,
    'harga_per_item' => 14000,
    'jumlah' => 2 * 14000,
],
[
    'tanggal' => '2025-08-05',
    'jenis_pengeluaran' => 'Nutrisi',
    'nama_item' => 'Zona 3',
    'keterangan' => null,
    'kuantitas' => 4,
    'harga_per_item' => 14000,
    'jumlah' => 4 * 14000,
],
    ];

    DB::table('transaksi_pengeluaran')->insert($data);
}




}

