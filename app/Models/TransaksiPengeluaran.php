<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiPengeluaran extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi_pengeluaran';
    
    protected $guarded = ['id'];

    protected $primaryKey = 'id'; 
    
    public $incrementing = true;

    public function scopeFilter($query, array $filters)
    {
        // 🔍 SEARCH
        if ($filters['search'] ?? false) {
            $search = $filters['search'];
            $query->where(function ($query) use ($search) {
                $query->where('jenis_pengeluaran', 'like', "%$search%")
                    ->orWhere('nama_item', 'like', "%$search%")
                    ->orWhere('keterangan', 'like', "%$search%");
            });
        }

        // 🔍 FILTER TANGGAL MULAI
        if ($filters['tanggal_mulai'] ?? false) {
            $query->whereDate('tanggal', '>=', $filters['tanggal_mulai']);
        }

        // 🔍 FILTER TANGGAL AKHIR
        if ($filters['tanggal_akhir'] ?? false) {
            $query->whereDate('tanggal', '<=', $filters['tanggal_akhir']);
        }
    }


}
