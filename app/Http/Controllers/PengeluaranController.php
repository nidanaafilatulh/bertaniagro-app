<?php

namespace App\Http\Controllers;

use App\Models\ItemPengeluaran;
use App\Models\JenisBeban;
use App\Models\JenisPengeluaran;
use App\Models\TransaksiPengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
        // $tanggal_mulai = DB::table('transaksi_pengeluaran')->max('tanggal');
        // $tanggal_akhir = DB::table('transaksi_pengeluaran')->max('tanggal');

        // Default auto-filters
        $filters = [
            'tanggal_mulai' => request('tanggal_mulai'),
            'tanggal_akhir' => request('tanggal_akhir'),
            'search' => request('search'),
        ];

        $daftar_jenis_pengeluaran = JenisPengeluaran::with([
            'itemPengeluaran' => function ($query) {
                $query->withCount('transaksiPengeluaran');
            }
        ])->get();

        $daftar_jenis_beban = JenisBeban::with([
            'jenisPengeluaran' => function ($query) {
                $query->withCount('itemPengeluaran');
            }
        ])->get();
        
        $daftarItemPengeluaran = ItemPengeluaran::select('id', 'nama', 'jenis_pengeluaran_id')->get();

        return view('pages.pengeluaran.index', [
            'title' => 'Daftar Pengeluaran',
            'tanggal_hari_ini' => $today,
            'daftar_jenis_beban' => $daftar_jenis_beban,
            'daftar_jenis_pengeluaran' => $daftar_jenis_pengeluaran,
            'daftar_item_pengeluaran' => $daftarItemPengeluaran,
            'daftar_pengeluaran' => TransaksiPengeluaran::latest()
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
            'daftar_jenis_pengeluaran' => JenisPengeluaran::with('itemPengeluaran')->get(),
            'tanggal' => $tanggal
        ]);
    }

    public function kumulatif()
    {
        $tanggal = now()->toDateString();

        return view('pages.pengeluaran.create.kumulatif', [
            'title' => 'Tambah Data Transaksi Pengeluaran Kumulatif',
            'daftar_jenis_pengeluaran' => JenisPengeluaran::with('itemPengeluaran')->get(),
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

        TransaksiPengeluaran::create([
            'tanggal'           => $validated['tanggal'],
            'id_item'           => $validated['nama_item'],
            'keterangan'        => $validated['keterangan'] ?? null,
            'kuantitas'         => $validated['kuantitas'],
            'harga_per_item'    => $validated['harga_per_item'],
            'jumlah'            => $validated['jumlah'],
        ]);

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
                'id_item'          => $validated['nama_item'][$i],
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
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'id_item' => 'required|exists:item_pengeluaran,id',
            'keterangan' => 'nullable|string',
            'kuantitas' => 'required|numeric',
            'harga_per_item' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        $pengeluaran->update($validated);

        return redirect()
            ->back()
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
