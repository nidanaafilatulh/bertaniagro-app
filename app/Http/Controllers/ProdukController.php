<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
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
        return view('pages.pemasukan.produk.create',[
            'title' => 'Tambah Data Produk',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama_produk.*' => 'required|string',
        'satuan.*' => 'required|string',
        'harga_satuan_normal.*' => 'required'
    ]);

    foreach ($request->nama_produk as $i => $produk) {

        $harga = preg_replace('/[^0-9]/', '', $request->harga_satuan_normal[$i]);

        Produk::create([
            'nama_produk' => $produk,
            'satuan' => $request->satuan[$i],
            'harga_satuan_normal' => $harga,
        ]);
    }

    return redirect('/pemasukan')
            ->with('success', 'Produk berhasil ditambahkan.')
            ->withFragment('tabs-produk');;
}

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $produk->update($request->all());

         return redirect()
            ->to(url()->previous())
            ->with('success', 'Data produk berhasil diperbarui!')
            ->withFragment('tabs-produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        return redirect()
        ->to(url()->previous())
        ->with('success', 'Produk berhasil dihapus!')
        ->withFragment('tabs-produk');
    }
}
