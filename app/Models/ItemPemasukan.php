<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPemasukan extends Model
{
    /** @use HasFactory<\Database\Factories\ItemPemasukanFactory> */
    use HasFactory;

    protected $table = 'item_pemasukan';
    protected $guarded = ['id'];

    public function pemasukan()
    {
        return $this->belongsTo(TransaksiPemasukan::class, 'no_transaksi', 'no_transaksi');
    }
}
