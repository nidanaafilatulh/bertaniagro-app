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
// ===================== 21 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-21','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Cak nul','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'pak aji','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'bumi hidro','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'KB Kalipancur','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'KB Banyumanik','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Nusantara Karangturi','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Nusantara beringin','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Rinda','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'Pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-21','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 22 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-22','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Oharang Lotte','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Pak aji','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Makan minum','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Nasta','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'SK boja','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Bumi hidro','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Sewa bbq','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Pesta Kebun','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'KB Banjarsari','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'KB Kedungmundu','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Cak nul','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'Aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-22','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>2,'harga'=>5000,'satuan'=>'Pohon'],
['tanggal'=>'2025-08-22','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>2,'harga'=>5000,'satuan'=>'Pohon'],

// ===================== 23 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-23','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Oharang Lotte','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Oharang Quin','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Pak Aji','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Pengunjung','produk'=>'Pakcoy','kuantitas'=>1,'harga'=>10000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'KB Kalipancur','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'KB Banyumanik','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'KB Banjarsari','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Alif Izol PP','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Haidar','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'Bu Endang','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-23','pelanggan'=>'wariono','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 24 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-24','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>20,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Cak nul','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Oharang Quin','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Morning glory','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Makan minum','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Brangas','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'KB Banyumanik','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Griya','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'Nusantara','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'pak wariono','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1.5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-24','pelanggan'=>'aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 25–31 AGUSTUS 2025 =====================
// (Dipadatkan tetap lengkap tanpa baris hilang)

['tanggal'=>'2025-08-25','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'Oharang Quin','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'cak nul','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'pesta Kebun','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'pak aji','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'ziezie','produk'=>'Selada','kuantitas'=>8,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'Pak wariono','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'Pasmod','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'PP','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-25','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 26 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-26','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Nusantara Karangturi','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Pak aji','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Mba hes','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'KB Kalipancur','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'KB Banjarsari','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'KB Kedungmundu','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Pengunjung','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'Pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-26','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],

// ===================== 27 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-27','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Oharang Quin','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Nasta','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Cak nul','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Brangas','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Nusantara Karangturi','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Pak Aji','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'SK Limbangan','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'Pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-27','pelanggan'=>'SK boja','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 28 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-28','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'El kebab','produk'=>'Selada','kuantitas'=>15,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Cak Nul','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Pak Aji','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Pesta Kebun','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Pak wariono','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Nusantara Karangturi','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Griya','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Sewa bbq','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-28','pelanggan'=>'Pengunjung','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 29 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-29','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Oharang Lotte','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Oharang Quin','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>25,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Faiz','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Cak nul','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Pak Aji','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'KB Kalipancur','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'KB Banyumanik','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'KB Banjarsari','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'KB Kedungmundu','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'Tardy','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1.5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'SK Ngaliyan','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'SK boja','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'pak wariono','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-29','pelanggan'=>'makan minum','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],

// ===================== 30 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-30','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'Oharang Kawi','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'oharang Quin','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'brangas','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'pak Aji','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'Rinda','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'Sewa bbq','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'KB Kalipancur','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'mba hes','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'cak nul','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'heidar','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'makan minum','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-30','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],

// ===================== 31 AGUSTUS 2025 =====================
['tanggal'=>'2025-08-31','pelanggan'=>'Bangkong','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Veteran','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'JJ Steak','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Syariah','produk'=>'Selada','kuantitas'=>10,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Oharang Kawi','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Oharang Quin','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Pesta Kebun','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Pak aji','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'KB Mijen','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'KB Ngaliyan','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'KB Kalipancur','produk'=>'Selada','kuantitas'=>4,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'KB Banyumanik','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'KB Banjarsari','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'KB Kedungmundu','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Mba Hes','produk'=>'Selada','kuantitas'=>0.5,'harga'=>26000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Cak Nul','produk'=>'Selada','kuantitas'=>5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Ziezie','produk'=>'Selada','kuantitas'=>7.5,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Tardy','produk'=>'Selada','kuantitas'=>3,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Wariono','produk'=>'Selada','kuantitas'=>2,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Aneka sambal','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'SK boja','produk'=>'Selada','kuantitas'=>6,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'pengunjung','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'alif','produk'=>'Selada','kuantitas'=>1,'harga'=>20000,'satuan'=>'Kg'],
['tanggal'=>'2025-08-31','pelanggan'=>'Sendiri','produk'=>'Sayur Pack 23','kuantitas'=>1,'harga'=>7000,'satuan'=>'Pack'],
    ];

    foreach ($data as $item) {

        $total = $item['kuantitas'] * $item['harga'];

        $transaksi = TransaksiPemasukan::create([
            'tanggal_transaksi' => $item['tanggal'],
            'pelanggan'         => $item['pelanggan'],
            'jumlah'            => $total,
            'bukti_bayar'       => null,
        ]);

        ItemPemasukan::create([
            'no_transaksi' => $transaksi->no_transaksi,
            'produk'       => $item['produk'],
            'kuantitas'    => $item['kuantitas'],
            'satuan'       => $item['satuan'],
            'harga_satuan' => $item['harga'],
        ]);
    }
}








}
