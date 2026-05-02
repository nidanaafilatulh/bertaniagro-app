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
        Schema::create('item_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_pengeluaran_id');
            $table->foreign('jenis_pengeluaran_id')
                ->references('id')
                ->on('jenis_pengeluaran')
                ->onDelete('cascade');
            $table->string('nama', 50);
            $table->unique(['jenis_pengeluaran_id', 'nama']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pengeluarans');
    }
};
