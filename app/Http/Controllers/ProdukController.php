<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Database\QueryException;
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
        return view('pages.pemasukan.produk.create', [
            'title' => 'Tambah Data Produk',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|array',
            'nama_produk.*' => ['required', 'string', 'max:50'],
            'satuan' => 'required|array',
            'satuan.*' => ['required', 'string'],
            'harga_satuan_normal' => 'required|array',
            'harga_satuan_normal.*' => ['required']
        ], [
            'nama_produk.*.required' => 'Nama produk wajib diisi.',
            'satuan.*.required' => 'Satuan wajib diisi.',
            'harga_satuan_normal.*.required' => 'Harga wajib diisi.',
        ]);

        $normalize = function ($value) {
            return preg_replace('/\s+/', '', strtolower(trim($value)));
        };

        $produks = Produk::select('nama_produk', 'satuan')->get();

        $kombinasi = [];

        foreach ($request->nama_produk as $i => $produk) {

            $satuan = $request->satuan[$i] ?? '';

            $produkNormalized = $normalize($produk);
            $satuanNormalized = $normalize($satuan);

            $key = $produkNormalized . '|' . $satuanNormalized;

            if (in_array($key, $kombinasi)) {
                return back()->withErrors([
                    "nama_produk.$i" => "Produk '{$produk}' dengan satuan '{$satuan}' sudah ada dalam input."
                ])->withInput();
            }

            $kombinasi[] = $key;

            foreach ($produks as $p) {

                $dbProduk = $normalize($p->nama_produk);
                $dbSatuan = $normalize($p->satuan);

                if ($dbProduk === $produkNormalized && $dbSatuan === $satuanNormalized) {
                    return back()->withErrors([
                        "nama_produk.$i" => "Produk '{$produk}' dengan satuan '{$satuan}' sudah ada di database."
                    ])->withInput();
                }
            }
        }

        foreach ($request->nama_produk as $i => $produk) {

            $harga = preg_replace('/[^0-9]/', '', $request->harga_satuan_normal[$i]);

            try {
                Produk::create([
                    'nama_produk' => trim($produk), // tetap rapi (pakai spasi)
                    'satuan' => trim($request->satuan[$i]),
                    'harga_satuan_normal' => $harga,
                ]);
            } catch (QueryException $e) {
                return back()->withErrors([
                    "nama_produk.$i" => "Produk '{$produk}' sudah ada (duplikat database)."
                ])->withInput();
            }
        }

        return redirect('/pemasukan')
            ->with('success', 'Produk berhasil ditambahkan.')
            ->withFragment('tabs-produk');
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
        $request->validate([
            'nama_produk' => ['required', 'string', 'max:50'],
            'satuan' => ['required', 'string', 'max:50'],
            'harga_satuan_normal' => ['required']
        ]);

        $normalize = fn($v) => preg_replace('/\s+/', '', strtolower(trim($v)));

        $namaInput = $normalize($request->nama_produk);
        $satuanInput = $normalize($request->satuan);

        $isDuplicate = Produk::where('id', '!=', $produk->id)
            ->get()
            ->contains(function ($p) use ($normalize, $namaInput, $satuanInput) {
                return $normalize($p->nama_produk) === $namaInput &&
                    $normalize($p->satuan) === $satuanInput;
            });

        if ($isDuplicate) {
            return back()
                ->withErrors([
                    'nama_produk' => "Produk '{$request->nama_produk}' dengan satuan '{$request->satuan}' sudah ada."
                ])
                ->withInput()
                ->with('open_modal', 'edit-produk')
                ->with('edit_id', $produk->id);
        }

        $harga = preg_replace('/[^0-9]/', '', $request->harga_satuan_normal);

        try {
            $produk->update([
                'nama_produk' => trim($request->nama_produk),
                'satuan' => trim($request->satuan),
                'harga_satuan_normal' => $harga,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {

            // fallback kalau ada constraint database (unique, dll)
            return back()
                ->withErrors([
                    'nama_produk' => "Terjadi duplikat data di database."
                ])
                ->withInput()
                ->with('open_modal', 'edit-produk')
                ->with('edit_id', $produk->id);
        }

        // 6. REDIRECT SUKSES (tetap di tab produk)
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
