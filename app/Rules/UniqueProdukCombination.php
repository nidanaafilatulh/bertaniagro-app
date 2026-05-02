<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Produk;

class UniqueProdukCombination implements ValidationRule
{
    protected $satuan;

    public function __construct($satuan)
    {
        $this->satuan = $satuan;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
{
    // 🔥 Normalisasi input
    $nama = preg_replace('/\s+/', '', strtolower(trim($value)));
    $satuan = preg_replace('/\s+/', '', strtolower(trim($this->satuan)));

    $produks = Produk::select('nama_produk', 'satuan')->get();

    foreach ($produks as $produk) {

        $dbNama = preg_replace('/\s+/', '', strtolower(trim($produk->nama_produk)));
        $dbSatuan = preg_replace('/\s+/', '', strtolower(trim($produk->satuan)));

        if ($dbNama === $nama && $dbSatuan === $satuan) {
            $fail("Produk '{$value}' dengan satuan '{$this->satuan}' sudah ada.");
            return;
        }
    }
}

}
