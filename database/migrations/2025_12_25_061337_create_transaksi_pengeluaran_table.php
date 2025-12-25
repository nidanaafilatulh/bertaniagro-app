<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                       // Tanggal
            $table->string('jenis_pengeluaran');          // Jenis Pengeluaran
            $table->string('nama_item');                  // Nama Item
            $table->string('keterangan')->nullable();    // Keterangan
            $table->decimal('kuantitas', 10, 2);                // Kuantitas
            $table->integer('harga_per_item');           // Harga per-Item
            $table->integer('jumlah'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pengeluaran');
    }
};
