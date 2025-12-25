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
        Schema::create('transaksi_pemasukan', function (Blueprint $table) {
            $table->integer('no_transaksi')->primary()->autoIncrement();
            $table->date('tanggal_transaksi');
            $table->string('pelanggan');
            $table->string('bukti_bayar')->nullable();
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pemasukan');
    }
};
