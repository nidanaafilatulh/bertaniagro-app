<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBeban extends Model
{
    protected $table = 'jenis_beban';

    protected $fillable = [
        'nama',
    ];


    public function jenisPengeluaran()
    {
        return $this->hasMany(JenisPengeluaran::class, 'id_beban');
    }

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = mb_strtolower($value, 'UTF-8');
    }

}
