<?php

namespace App\Http\Controllers;

use App\Models\ItemPengeluaran;
use App\Models\JenisPengeluaran;
use Illuminate\Http\Request;

class ItemPengeluaranController extends Controller
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
        return view('pages.pengeluaran.itemPengeluaran.create', [
            'title' => 'Tambah Item Pengeluaran',
            'daftar_jenis_pengeluaran' => JenisPengeluaran::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'jenis_pengeluaran.*' => 'required|exists:jenis_pengeluaran,id',
        'nama_item.*' => 'required|string|max:255',
    ]);

    foreach ($request->nama_item as $index => $nama) {
        ItemPengeluaran::create([
            'jenis_pengeluaran_id' => $request->jenis_pengeluaran[$index],
            'nama' => $nama,
        ]);
    }

    return redirect('/pengeluaran')
        ->with('success', 'Item Pengeluaran berhasil ditambahkan.')
        ->withFragment('tabs-items');
}


    /**
     * Display the specified resource.
     */
    public function show(ItemPengeluaran $itemPengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemPengeluaran $itemPengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemPengeluaran $itemPengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPengeluaran $itemPengeluaran)
    {
        ItemPengeluaran::destroy($itemPengeluaran->id);
        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data item pengeluaran berhasil dihapus!')
            ->withFragment('tabs-items');
    }
}
