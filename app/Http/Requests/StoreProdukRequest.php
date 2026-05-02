<?php

namespace App\Http\Requests;

use App\Rules\UniqueProdukCombination;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    protected function prepareForValidation()
    {
        $this->merge([
            'nama_produk' => array_map(
                fn($v) => preg_replace('/\s+/', '', strtolower(trim($v))),
                $this->nama_produk ?? []
            ),
            'satuan' => array_map(
                fn($v) => preg_replace('/\s+/', '', strtolower(trim($v))),
                $this->satuan ?? []
            )
        ]);
    }
    public function rules()
    {
        $rules = [
            'nama_produk' => 'required|array',
            'nama_produk.*' => ['required', 'string', 'max:50'],
            'satuan' => 'required|array',
            'satuan.*' => ['required', 'string'],
            'harga_satuan_normal' => 'required|array',
            'harga_satuan_normal.*' => ['required']
        ];

        foreach ($this->nama_produk ?? [] as $i => $produk) {
            $rules["nama_produk.$i"][] = new UniqueProdukCombination(
                $this->satuan[$i] ?? null
            );
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nama_produk.*.required' => 'Nama produk wajib diisi.',
            'satuan.*.required' => 'Satuan wajib diisi.',
            'harga_satuan_normal.*.required' => 'Harga wajib diisi.',
        ];
    }

    /**
     * 🔥 Validasi tambahan: duplikasi dalam 1 request
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $kombinasi = [];

            foreach ($this->nama_produk ?? [] as $i => $produk) {

                $nama = $produk; // sudah dinormalisasi
                $satuan = $this->satuan[$i] ?? '';

                $key = $nama . '|' . $satuan;

                if (in_array($key, $kombinasi)) {
                    $validator->errors()->add(
                        "nama_produk.$i",
                        "Duplikasi produk dalam input."
                    );
                }

                $kombinasi[] = $key;
            }
        });
    }
}
