<?php

namespace App\Http\Controllers;

use App\Models\JenisBeban;
use App\Models\JenisPengeluaran;
use Illuminate\Http\Request;

class JenisPengeluaranController extends Controller
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
        return view('pages.pengeluaran.jenisPengeluaran.create', [
            'title' => 'Tambah Jenis Pengeluaran',
            'daftar_jenis_beban' => JenisBeban::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_pengeluaran' => 'required|array',
            'nama_jenis_pengeluaran.*' => [
                'required',
                'string',
                'max:50',
            ],
            'jenis_beban' => 'required|array',
            'jenis_beban.*' => 'required|exists:jenis_beban,id',
        ], [
            'nama_jenis_pengeluaran.*.required' => 'Nama jenis pengeluaran wajib diisi.',
            'jenis_beban.*.required' => 'Jenis beban wajib dipilih.',
            'jenis_beban.*.exists' => 'Jenis beban tidak valid.',
        ]);

        $normalize = fn($v) => preg_replace('/\s+/', '', strtolower(trim($v)));

        $namaSudahAda = [];

        foreach ($request->nama_jenis_pengeluaran as $i => $nama) {

            $namaNormalized = $normalize($nama);

            if (in_array($namaNormalized, $namaSudahAda)) {
                return back()->withErrors([
                    "nama_jenis_pengeluaran.$i" => "Tidak boleh ada nama yang sama."
                ])->withInput();
            }

            $namaSudahAda[] = $namaNormalized;

            $data = JenisPengeluaran::select('nama')->get();

            foreach ($data as $item) {
                $dbNama = $normalize($item->nama);

                if ($dbNama === $namaNormalized) {
                    return back()->withErrors([
                        "nama_jenis_pengeluaran.$i" => "Nama '{$nama}' sudah ada."
                    ])->withInput();
                }
            }
        }

        foreach ($request->nama_jenis_pengeluaran as $i => $nama) {
            JenisPengeluaran::create([
                'id_beban' => $request->jenis_beban[$i],
                'nama' => trim($nama), // tetap simpan rapi
            ]);
        }

        return redirect('/pengeluaran')
            ->with('success', 'Jenis Pengeluaran berhasil ditambahkan.')
            ->withFragment('tabs-items');
    }


    /**
     * Display the specified resource.
     */
    public function show(JenisPengeluaran $jenisPengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPengeluaran $jenisPengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPengeluaran $jenisPengeluaran)
    {
        // 1. VALIDASI DASAR
        $request->validate([
            'nama_jenis_pengeluaran' => 'required|string|max:255',
            'jenis_beban' => 'required|exists:jenis_beban,id',
        ]);

        // 2. NORMALISASI
        $namaInput = preg_replace('/\s+/', '', strtolower(trim($request->nama_jenis_pengeluaran)));

        // 3. CEK DUPLIKAT (SELain dirinya sendiri)
        $isDuplicate = JenisPengeluaran::where('id', '!=', $jenisPengeluaran->id)
            ->whereRaw('LOWER(REPLACE(nama, " ", "")) = ?', [$namaInput])
            ->exists();

        if ($isDuplicate) {
            return back()
                ->withErrors([
                    'nama_jenis_pengeluaran' => 'Nama jenis pengeluaran sudah ada.'
                ])
                ->withInput()
                ->with('open_modal', 'edit-jenis')
                ->with('edit_id', $jenisPengeluaran->id);
        }

        // 4. UPDATE
        $jenisPengeluaran->update([
            'nama' => trim($request->nama_jenis_pengeluaran),
            'id_beban' => $request->jenis_beban,
        ]);

        // 5. REDIRECT
        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data jenis pengeluaran berhasil diperbarui!')
            ->withFragment('tabs-items');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisPengeluaran $jenisPengeluaran)
    {
        JenisPengeluaran::destroy($jenisPengeluaran->id);
        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data jenis pengeluaran berhasil dihapus!')
            ->withFragment('tabs-items');
    }
}
