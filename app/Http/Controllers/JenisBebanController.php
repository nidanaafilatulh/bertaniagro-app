<?php

namespace App\Http\Controllers;

use App\Models\JenisBeban;
use App\Rules\UniqueNamaTanpaSpasi;
use Illuminate\Http\Request;

class JenisBebanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengeluaran.jenisBeban.create', [
            'title' => 'Tambah Jenis Beban',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'nama_jenis_beban' => array_map(
                fn($v) => strtolower(trim($v)),
                $request->nama_jenis_beban ?? []
            )
        ]);

        $request->validate([
            'nama_jenis_beban' => 'required|array',
            'nama_jenis_beban.*' => [
                'required',
                'string',
                'max:50',
                'distinct',
                new UniqueNamaTanpaSpasi('jenis_beban', 'nama')
            ],
        ], [
            'nama_jenis_beban.required' => 'Data tidak boleh kosong.',
            'nama_jenis_beban.*.required' => 'Nama jenis beban wajib diisi.',
            'nama_jenis_beban.*.distinct' => 'Tidak boleh ada nama jenis beban yang sama dalam input.',
            'nama_jenis_beban.*.unique' => 'Nama jenis beban sudah ada di database.',
        ]);

        foreach ($request->nama_jenis_beban as $nama) {
            JenisBeban::create([
                'nama' => $nama, // sudah bersih & lowercase
            ]);
        }

        return redirect('/pengeluaran')
            ->with('success', 'Jenis Beban berhasil ditambahkan.')
            ->withFragment('tabs-items');
    }



    /**
     * Display the specified resource.
     */
    public function show(JenisBeban $jenisBeban)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisBeban $jenisBeban)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisBeban $jenisBeban)
    {
        $request->validate([
            'nama_jenis_beban' => 'required|string|max:255',
        ]);

        $inputNama = preg_replace('/\s+/', '', strtolower(trim($request->nama_jenis_beban)));

        $isDuplicate = JenisBeban::where('id', '!=', $jenisBeban->id)
            ->whereRaw('LOWER(REPLACE(nama, " ", "")) = ?', [$inputNama])
            ->exists();

        if ($isDuplicate) {
            return back()
                ->withErrors([
                    'nama_jenis_beban' => "Nama jenis beban sudah ada."
                ])
                ->withInput()
                ->with('open_modal', 'edit-beban') // kalau kamu pakai reopen modal
                ->with('edit_id', $jenisBeban->id);
        }

        $jenisBeban->update([
            'nama' => trim($request->nama_jenis_beban),
        ]);

        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data jenis beban berhasil diubah!')
            ->withFragment('tabs-items');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisBeban $jenisBeban)
    {
        JenisBeban::destroy($jenisBeban->id);
        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data jenis beban berhasil dihapus!')
            ->withFragment('tabs-items');
    }
}
