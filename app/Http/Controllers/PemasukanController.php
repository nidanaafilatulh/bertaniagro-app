<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ItemPemasukan;
use App\Models\TransaksiPemasukan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PemasukanController extends Controller
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
    $tanggal_mulai = DB::table('transaksi_pemasukan')->max('tanggal_transaksi');
    $tanggal_akhir = DB::table('transaksi_pemasukan')->max('tanggal_transaksi');

    // Default auto-filters
    $filters = [
        'tanggal_mulai' => request('tanggal_mulai', $tanggal_mulai),
        'tanggal_akhir' => request('tanggal_akhir', $tanggal_akhir),
        'search' => request('search'),
    ];

    return view('pages.pemasukan.index', [
        'title' => 'Pemasukan',
        'tanggal_hari_ini' => $today,
        'tanggal_mulai' => $filters['tanggal_mulai'],
        'tanggal_akhir' => $filters['tanggal_akhir'],
        'daftar_pemasukan' => TransaksiPemasukan::latest()
            ->filter($filters)
            ->paginate($show)
            ->withQueryString()
    ]);
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get last no_transaksi
        $last = TransaksiPemasukan::max('no_transaksi');

        // next no_transaksi (if empty → start at 1)
        $nextNo = $last ? $last + 1 : 1;
        $tanggal = now()->toDateString();

        return view('pages.pemasukan.create', [
            'title' => 'Tambah Data Transaksi Pemasukan',
            'nextNo' => $nextNo,
            'tanggal' => $tanggal
        ]);
    }

    public function kumulatif()
    {
        $tanggal = now()->toDateString();

        return view('pages.pemasukan.create.kumulatif', [
            'title' => 'Tambah Data Transaksi Pemasukan',
            'tanggal' => $tanggal
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // --- CLEAN Rp FORMATTED INPUTS ---
        $cleanHarga = [];
        foreach ($request->harga_satuan as $h) {
            $cleanHarga[] = preg_replace('/[^0-9]/', '', $h) ?: 0;
        }

        $cleanTotal = preg_replace('/[^0-9]/', '', $request->total_keseluruhan) ?: 0;

        // Replace original request values with cleaned versions
        $request->merge([
            'harga_satuan' => $cleanHarga,
            'total_keseluruhan' => $cleanTotal,
        ]);

        // --- VALIDATION ---
        $request->validate([
            'pelanggan'          => 'required|string',
            'tanggal_transaksi'  => 'required|date',
            'total_keseluruhan'  => 'required|numeric|min:0',
            'bukti_bayar'        => 'nullable|file|mimes:jpg,jpeg,png|max:10240',

            'produk.*'           => 'required|string',
            'kuantitas.*'        => 'required|numeric|min:0.01',
            'satuan.*'           => 'required|string',
            'harga_satuan.*'     => 'required|numeric|min:0',
        ]);

        // --- SIMPAN MASTER TRANSAKSI ---
        $transaksi = TransaksiPemasukan::create([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'pelanggan'         => $request->pelanggan,
            'jumlah'            => $request->total_keseluruhan,
            'bukti_bayar'       => null,
        ]);

        // --- SIMPAN FILE BUKTI BAYAR ---
        if ($request->hasFile('bukti_bayar')) {
            $extension = $request->file('bukti_bayar')->getClientOriginalExtension();
            $fileName = $transaksi->no_transaksi . '.' . $extension;

            $request->file('bukti_bayar')->storeAs('bukti_bayar', $fileName, 'public');

            $transaksi->update(['bukti_bayar' => $fileName]);
        }

        // --- SIMPAN DETAIL ITEM ---
        for ($i = 0; $i < count($request->produk); $i++) {
            ItemPemasukan::create([
                'no_transaksi' => $transaksi->no_transaksi,
                'produk'       => $request->produk[$i],
                'kuantitas'    => $request->kuantitas[$i],
                'satuan'       => $request->satuan[$i],
                'harga_satuan' => $request->harga_satuan[$i], // now clean integer
            ]);
        }

        return redirect('/pemasukan')->with('success', 'Transaksi pemasukan berhasil disimpan.');
    }

    public function storeKumulatif(Request $request)
    {
        // --- CLEAN Rp FORMATTED INPUTS ---
        $cleanHarga = [];
        foreach ($request->harga_satuan as $h) {
            $cleanHarga[] = preg_replace('/[^0-9]/', '', $h) ?: 0;
        }

        $cleanJumlah = [];
        foreach ($request->jumlah as $j) {
            $cleanJumlah[] = preg_replace('/[^0-9]/', '', $j) ?: 0;
        }

        // Replace original request values with cleaned versions
        $request->merge([
            'harga_satuan' => $cleanHarga,
            'jumlah' => $cleanJumlah,
        ]);

        // --- VALIDATION ---
        $validatedData = $request->validate([
            'tanggal_transaksi'  => 'required|date',

            'pelanggan.*'          => 'required|string',
            'produk.*'           => 'required|string',
            'kuantitas.*'        => 'required|numeric|min:0.01',
            'satuan.*'           => 'required|string',
            'harga_satuan.*'     => 'required|numeric|min:0',
            'jumlah.*'           => 'required|numeric|min:0',
        ]);

        // --- SIMPAN DETAIL ITEM ---
        for ($i = 0; $i < count($request->pelanggan); $i++) {
            $transaksi = TransaksiPemasukan::create([
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'pelanggan'         => $request->pelanggan[$i],
                'jumlah'            => $request->jumlah[$i],
                'bukti_bayar'       => null,
            ]);

            ItemPemasukan::create([
                'no_transaksi' => $transaksi->no_transaksi,
                'produk'       => $request->produk[$i],
                'kuantitas'    => $request->kuantitas[$i],
                'satuan'       => $request->satuan[$i],
                'harga_satuan' => $request->harga_satuan[$i], // now clean integer
            ]);
        }

        return redirect('/pemasukan')->with('success', 'Transaksi pemasukan berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(TransaksiPemasukan $pemasukan)
    {
        return view('pages.pemasukan.show', [
            'title' => 'Detail Transaksi Pemasukan',
            'pemasukan' => $pemasukan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiPemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiPemasukan $pemasukan)
    {
        $validator = Validator::make($request->all(), [
            'bukti_bayar' => 'required|mimes:jpg,png|max:10240',
        ], [
            'bukti_bayar.required' => 'File bukti bayar harus diunggah.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('upload_no_transaksi', $request->no_transaksi);
        }

        if ($request->hasFile('bukti_bayar')) {
            $noTransaksi = $pemasukan->no_transaksi;

            $extension = $request->file('bukti_bayar')->getClientOriginalExtension();
            $fileName = $noTransaksi . '.' . $extension;

            $request->bukti_bayar->storeAs('bukti_bayar', $fileName, 'public');

            $pemasukan->bukti_bayar = $fileName;
            $pemasukan->save();
        }

        return redirect()
            ->to(url()->previous())
            ->with('success', 'Bukti bayar berhasil diunggah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiPemasukan $pemasukan)
    {
        TransaksiPemasukan::destroy($pemasukan->no_transaksi);
        return redirect()
        ->to(url()->previous())
        ->with('success', 'Transaksi pemasukan berhasil dihapus!');
    }
}
