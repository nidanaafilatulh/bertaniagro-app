<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk',
        'satuan',
        'harga_satuan_normal'
    ];

    public function itemPemasukan()
    {
        return $this->hasMany(ItemPemasukan::class, 'id_produk', 'id');
    }

   
    public function setNamaProdukAttribute($value)
    {
        $this->attributes['nama_produk'] = mb_strtolower($value, 'UTF-8');
    }

}


