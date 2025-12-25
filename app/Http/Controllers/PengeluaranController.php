<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPengeluaran;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $show = request('show', 10);


        // Date range based on existing data
        $tanggal_mulai = DB::table('transaksi_pengeluaran')->max('tanggal');
        $tanggal_akhir = DB::table('transaksi_pengeluaran')->max('tanggal');

        // Default auto-filters
        $filters = [
            'tanggal_mulai' => request('tanggal_mulai', $tanggal_mulai),
            'tanggal_akhir' => request('tanggal_akhir', $tanggal_akhir),
            'search' => request('search'),
        ];

        return view('pages.pengeluaran.index', [
            'title' => 'Daftar Pengeluaran',
            'tanggal_hari_ini' => $today,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            'daftar_pengeluaran' => TransaksiPengeluaran::latest('tanggal')
                                                        ->filter($filters)
                                                        ->paginate($show)
                                                        ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tanggal = now()->toDateString();

        return view('pages.pengeluaran.create', [
            'title' => 'Tambah Data Transaksi Pengeluaran', 
            'tanggal' => $tanggal
        ]);
    }

    public function kumulatif()
    {
        $tanggal = now()->toDateString();

        return view('pages.pengeluaran.create.kumulatif', [
            'title' => 'Tambah Data Transaksi Pengeluaran Kumulatif',
            'tanggal' => $tanggal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'harga_per_item' => preg_replace('/[^0-9]/', '', $request->harga_per_item),
            'jumlah' => preg_replace('/[^0-9]/', '', $request->jumlah),
            'kuantitas'      => str_replace(',', '.', $request->kuantitas),
        ]);

        $validated = $request->validate([
            'tanggal'           => 'required|date',
            'jenis_pengeluaran' => 'required|string',
            'nama_item'         => 'required|string',
            'keterangan'        => 'nullable|string',
            'kuantitas'         => 'required|numeric|min:0.01',
            'harga_per_item'    => 'required|integer|min:0',
            'jumlah'            => 'required|integer|min:0',
        ]);

        $validated['jumlah'] = $validated['kuantitas'] * $validated['harga_per_item'];

        TransaksiPengeluaran::create($validated);

        return redirect('/pengeluaran')->with('success', 'Transaksi pengeluaran berhasil ditambahkan!');
    }
    public function storeKumulatif(Request $request)
    {
        // === 1. Bersihkan harga & jumlah (format rupiah) ===
        $cleanHarga = [];
        foreach ($request->harga_per_item as $h) {
            $cleanHarga[] = (int) preg_replace('/[^0-9]/', '', $h);
        }

        $cleanJumlah = [];
        foreach ($request->jumlah as $j) {
            $cleanJumlah[] = (int) preg_replace('/[^0-9]/', '', $j);
        }

        $request->merge([
            'harga_per_item' => $cleanHarga,
            'jumlah' => $cleanJumlah,
        ]);

        // === 2. Validasi ===
        $validated = $request->validate([
            'tanggal'             => 'required|date',
            'jenis_pengeluaran.*' => 'required|string',
            'nama_item.*'         => 'required|string',
            'kuantitas.*'         => 'required|numeric|min:0.01',
            'harga_per_item.*'    => 'required|integer|min:0',
            'jumlah.*'            => 'required|integer|min:0',
        ]);

        // === 3. Simpan ke database ===
        for ($i = 0; $i < count($request->jenis_pengeluaran); $i++) {
            TransaksiPengeluaran::create([
                'tanggal'            => $validated['tanggal'],
                'jenis_pengeluaran'  => $validated['jenis_pengeluaran'][$i],
                'nama_item'          => $validated['nama_item'][$i],
                'kuantitas'          => $validated['kuantitas'][$i],
                'harga_per_item'     => $validated['harga_per_item'][$i],
                'jumlah'             => $validated['jumlah'][$i],
            ]);
        }

        return redirect('/pengeluaran')->with('success', 'Transaksi pengeluaran berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(TransaksiPengeluaran $transaksiPengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiPengeluaran $transaksiPengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiPengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->all());

         return redirect()
            ->to(url()->previous())
            ->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiPengeluaran $pengeluaran)
    {
        $pengeluaran::destroy($pengeluaran->id);
        return redirect()
        ->to(url()->previous())
        ->with('success', 'Transaksi pengeluaran berhasil dihapus!');
    }
}
