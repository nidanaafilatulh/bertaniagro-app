<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPengeluaran extends Model
{
    protected $table = 'item_pengeluaran';

    protected $fillable = [
        'jenis_pengeluaran_id',
        'nama',
    ];

    public function jenisPengeluaran()
    {
        return $this->belongsTo(JenisPengeluaran::class, 'jenis_pengeluaran_id');
    }

    public function transaksiPengeluaran()
    {
        return $this->hasMany(TransaksiPengeluaran::class, 'id_item');
    }
}
