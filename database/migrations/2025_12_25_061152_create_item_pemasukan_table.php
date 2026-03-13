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
        Schema::create('item_pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_transaksi');
            $table->foreign('no_transaksi')
                ->references('no_transaksi')
                ->on('transaksi_pemasukan')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')
                ->references('id')
                ->on('produk')
                ->onDelete('cascade');
            $table->decimal('kuantitas', 10, 2);
            $table->unsignedBigInteger('harga_satuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pemasukan');
    }
};
