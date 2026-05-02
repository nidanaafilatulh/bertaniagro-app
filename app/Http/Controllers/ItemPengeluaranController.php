<?php

namespace App\Http\Controllers;

use App\Models\ItemPengeluaran;
use App\Models\JenisPengeluaran;
use Illuminate\Database\QueryException;
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
            'jenis_pengeluaran' => 'required|array',
            'jenis_pengeluaran.*' => 'required|exists:jenis_pengeluaran,id',
            'nama_item' => 'required|array',
            'nama_item.*' => [
                'required',
                'string',
                'max:50'
            ],
        ], [
            'nama_item.*.required' => 'Nama item wajib diisi.',
        ]);

        $normalize = function ($value) {
            return preg_replace('/\s+/', '', strtolower(trim($value)));
        };

        $kombinasi = [];

        foreach ($request->nama_item as $i => $nama) {

            $jenisId = $request->jenis_pengeluaran[$i];

            $namaNormalized = $normalize($nama);

            $key = $jenisId . '|' . $namaNormalized;

            if (in_array($key, $kombinasi)) {
                return back()->withErrors([
                    "nama_item.$i" => "Duplikasi item dalam input."
                ])->withInput();
            }

            $kombinasi[] = $key;

            $items = ItemPengeluaran::where('jenis_pengeluaran_id', $jenisId)
                ->select('nama')
                ->get();

            foreach ($items as $item) {

                $dbNama = $normalize($item->nama);

                if ($dbNama === $namaNormalized) {
                    return back()->withErrors([
                        "nama_item.$i" => "Item '{$nama}' sudah ada pada jenis pengeluaran tersebut."
                    ])->withInput();
                }
            }
        }

        foreach ($request->nama_item as $i => $nama) {

            try {
                ItemPengeluaran::create([
                    'jenis_pengeluaran_id' => $request->jenis_pengeluaran[$i],
                    'nama' => trim($nama), // tetap simpan versi asli (rapi)
                ]);
            } catch (QueryException $e) {
                return back()->withErrors([
                    "nama_item.$i" => "Item '{$nama}' sudah ada (duplikat database)."
                ])->withInput();
            }
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
        $request->validate([
            'jenis_pengeluaran' => 'required|exists:jenis_pengeluaran,id',
            'nama_item_pengeluaran' => 'required|string|max:255',
        ]);

        $namaInput = preg_replace('/\s+/', '', strtolower(trim($request->nama_item_pengeluaran)));

       
        $isDuplicate = ItemPengeluaran::where('id', '!=', $itemPengeluaran->id)
            ->where('jenis_pengeluaran_id', $request->jenis_pengeluaran)
            ->whereRaw('LOWER(REPLACE(nama, " ", "")) = ?', [$namaInput])
            ->exists();

        if ($isDuplicate) {
            return back()
                ->withErrors([
                    'nama_item_pengeluaran' => 'Item pengeluaran dengan jenis yang sama sudah ada.'
                ])
                ->withInput()
                ->with('open_modal', 'edit-item')
                ->with('edit_id', $itemPengeluaran->id);
        }

        $itemPengeluaran->update([
            'jenis_pengeluaran_id' => $request->jenis_pengeluaran,
            'nama' => trim($request->nama_item_pengeluaran),
        ]);

        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data item pengeluaran berhasil diperbarui!')
            ->withFragment('tabs-items');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemPengeluaran $itemPengeluaran)
    {
        if ($itemPengeluaran->transaksiPengeluaran()->exists()) {
            return back()->with('error', 'Item sudah digunakan dalam transaksi.');
        }

        ItemPengeluaran::destroy($itemPengeluaran->id);
        return redirect()
            ->to(url()->previous())
            ->with('success', 'Data item pengeluaran berhasil dihapus!')
            ->withFragment('tabs-items');
    }
}
