<?php

namespace App\Http\Controllers;

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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_pengeluaran.*' => 'required|string|max:255',
        ]);

        foreach ($request->nama_jenis_pengeluaran as $nama) {
            JenisPengeluaran::create([
                'nama' => $nama,
            ]);
        }

        return redirect('/pengeluaran')
            ->with('success', 'Jenis Pengeluaran berhasil ditambahkan.')
            ->withFragment('tabs-items');;
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
        //
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
