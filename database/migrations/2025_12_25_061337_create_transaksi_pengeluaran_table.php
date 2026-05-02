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
            $table->unsignedBigInteger('id_item');                  // Nama Item
            $table->foreign('id_item')
                ->references('id')
                ->on('item_pengeluaran')
                ->onDelete('cascade');
            $table->string('keterangan', 150)->nullable();    // Keterangan
            $table->decimal('kuantitas', 10, 2);                // Kuantitas
            $table->unsignedBigInteger('harga_per_item');           // Harga per-Item
            $table->unsignedBigInteger('jumlah'); 
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
