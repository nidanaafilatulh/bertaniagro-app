<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPengeluaran extends Model
{
    protected $table = 'jenis_pengeluaran';

    protected $fillable = [
        'nama',
    ];

    public function itemPengeluaran()
    {
        return $this->hasMany(ItemPengeluaran::class, 'jenis_pengeluaran_id');
    }
}
