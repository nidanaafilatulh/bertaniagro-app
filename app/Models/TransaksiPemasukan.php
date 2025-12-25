<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPemasukan extends Model
{
    /** @use HasFactory<\Database\Factories\PemasukanFactory> */
    use HasFactory;

    protected $table = 'transaksi_pemasukan';
    protected $primaryKey = 'no_transaksi';
    protected $keyType = 'int';
    protected $guarded = ['no_transaksi'];

    public function getRouteKeyName()
    {
        return 'no_transaksi';
    }

    public function itemPemasukan()
    {
        return $this->hasMany(ItemPemasukan::class, 'no_transaksi', 'no_transaksi');
    }

    public function scopeFilter($query, array $filters)
    {
        // 🔍 SEARCH
        if ($filters['search'] ?? false) {
            $search = $filters['search'];

            $query->where(function ($query) use ($search) {

                // cari di tabel transaksi_pemasukan
                $query->where('pelanggan', 'like', "%$search%")
                    ->orWhere('jumlah', 'like', "%$search%");

                // 🔍 cari produk di tabel item_pemasukan
                $query->orWhereHas('itemPemasukan', function ($q) use ($search) {
                    $q->where('produk', 'like', "%$search%");
                });
            });
        }

        // 🔍 FILTER TANGGAL MULAI
        if ($filters['tanggal_mulai'] ?? false) {
            $query->whereDate('tanggal_transaksi', '>=', $filters['tanggal_mulai']);
        }

        // 🔍 FILTER TANGGAL AKHIR
        if ($filters['tanggal_akhir'] ?? false) {
            $query->whereDate('tanggal_transaksi', '<=', $filters['tanggal_akhir']);
        }
    }

}
