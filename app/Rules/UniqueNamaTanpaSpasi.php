<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueNamaTanpaSpasi implements ValidationRule
{
    protected $table;
    protected $column;
    protected $ignoreId;
    protected $idColumn;

    public function __construct($table, $column = 'nama', $ignoreId = null, $idColumn = 'id')
    {
        $this->table = $table;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
        $this->idColumn = $idColumn;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $normalized = strtolower(preg_replace('/\s+/', '', $value));

        $query = DB::table($this->table)
            ->whereRaw("LOWER(REPLACE({$this->column}, ' ', '')) = ?", [$normalized]);

        // 🔥 untuk kebutuhan update (optional)
        if ($this->ignoreId) {
            $query->where($this->idColumn, '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail('Nama sudah ada');
        }
    }
}
