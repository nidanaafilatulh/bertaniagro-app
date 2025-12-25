<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanKeuanganController extends Controller
{
    // public function cashflow(Request $request)
    // {
    //     Carbon::setLocale('id');
    //     $today = Carbon::now()->translatedFormat('d F Y');
    //     $tanggal_mulai = $request->tanggal_mulai;
    //     $tanggal_akhir = $request->tanggal_akhir;
    //     $tanggal = now()->toDateString();

    //     $total_pemasukan_sebelum = 0;
    //     $total_pengeluaran_sebelum = 0;

    //     if (!empty($tanggal_mulai)) {
    //         $total_pemasukan_sebelum = DB::table('transaksi_pemasukan')
    //             ->whereDate('tanggal_transaksi', '<', $tanggal_mulai)
    //             ->sum('jumlah');

    //         $total_pengeluaran_sebelum = DB::table('transaksi_pengeluaran')
    //             ->whereDate('tanggal', '<', $tanggal_mulai)
    //             ->sum('jumlah');
    //     }

    //     $saldo_awal = $total_pemasukan_sebelum - $total_pengeluaran_sebelum;

    //     // ============================
    //     // 2. AMBIL CASHFLOW PERIODE
    //     // ============================

    //     $pemasukan = DB::table('transaksi_pemasukan')
    //         ->select(
    //             'tanggal_transaksi as tanggal',
    //             DB::raw('SUM(jumlah) as total_jumlah'),
    //             DB::raw('"pemasukan" as kategori')
    //         )
    //         ->whereBetween('tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
    //         ->groupBy('tanggal_transaksi');

    //     $pengeluaran = DB::table('transaksi_pengeluaran')
    //         ->select(
    //             'tanggal',
    //             DB::raw('SUM(jumlah) as total_jumlah'),
    //             DB::raw('"pengeluaran" as kategori')
    //         )
    //         ->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])
    //         ->groupBy('tanggal');

    //     $data = $pemasukan
    //         ->unionAll($pengeluaran)
    //         ->orderBy('tanggal', 'asc')
    //         ->get();


    //     // ============================
    //     // RETURN DATA KE VIEW
    //     // ============================

    //     return view('pages.keuangan.cashflow.index', [
    //         "title" => 'Laporan Cashflow',
    //         'tanggal_hari_ini' => $today,
    //         'tanggal' => $tanggal,
    //         "saldo_awal" => $saldo_awal,
    //         "data" => $data
    //     ]);
    // }
    
    
    public function cashflow(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        $tanggal = now()->toDateString();

        $total_pemasukan_sebelum = 0;
        $total_pengeluaran_sebelum = 0;

        if (!empty($tanggal_mulai)) {
            $total_pemasukan_sebelum = DB::table('transaksi_pemasukan')
                ->whereDate('tanggal_transaksi', '<', $tanggal_mulai)
                ->sum('jumlah');

            $total_pengeluaran_sebelum = DB::table('transaksi_pengeluaran')
                ->whereDate('tanggal', '<', $tanggal_mulai)
                ->sum('jumlah');
        }

        $saldo_awal = $total_pemasukan_sebelum - $total_pengeluaran_sebelum;

        // ============================
        // 2. AMBIL CASHFLOW PERIODE
        // ============================

        $queryPemasukanSelada = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"selada" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->whereIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                        ->whereRaw('LOWER(i.satuan) != "pack" AND LOWER(i.produk) = "selada"');
                })
                ->orWhere(function ($sub) {
                    $sub->whereNotIn('t.pelanggan', ['Aeon Mall', 'Istana Buah']);
                });
            })
            ->whereRaw('(LOWER(i.produk) = "selada")')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $queryPemasukanPackAeon = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"aeon" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where('t.pelanggan', 'Aeon Mall')
            ->where('i.satuan', 'Pack')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $queryPemasukanPackIstana = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"istana" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where('t.pelanggan', 'Istana Buah')
            ->where('i.satuan', 'Pack')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $queryPemasukanLainnya = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"lainnya" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->whereIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                        ->whereRaw('LOWER(i.satuan) != "pack"');
                })
                ->orWhere(function ($sub) {
                    $sub->whereNotIn('t.pelanggan', ['Aeon Mall', 'Istana Buah']);
                });
            })
            ->whereRaw('NOT (LOWER(i.produk) = "selada")')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');


        $pengeluaran = DB::table('transaksi_pengeluaran')
                        ->select(
                            'tanggal',
                            'jenis_pengeluaran as deskripsi',
                            DB::raw('SUM(jumlah) as total_jumlah'),
                            DB::raw('"pengeluaran" as kategori')
                        )
                        ->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])
                        ->groupBy('tanggal', 'jenis_pengeluaran');

        
        $data = $queryPemasukanSelada
                ->unionAll($queryPemasukanPackAeon)
                ->unionAll($queryPemasukanPackIstana)
                ->unionAll($queryPemasukanLainnya)
                ->unionAll($pengeluaran)
                ->orderBy('tanggal', 'asc')
                ->get();


        $dataGrouped = $data->groupBy('tanggal');
        // ============================
        // RETURN DATA KE VIEW
        // ============================

        return view('pages.keuangan.cashflow.index', [
            "title" => 'Laporan Cashflow',
            'tanggal_hari_ini' => $today,
            'tanggal' => $tanggal,
            "saldo_awal" => $saldo_awal,
            "data" => $dataGrouped,
        ]);
    }

    public function cetakCashflow(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;

        $total_pemasukan_sebelum = 0;
        $total_pengeluaran_sebelum = 0;

        if (!empty($tanggal_mulai)) {
            $total_pemasukan_sebelum = DB::table('transaksi_pemasukan')
                ->whereDate('tanggal_transaksi', '<', $tanggal_mulai)
                ->sum('jumlah');
            $total_pengeluaran_sebelum = DB::table('transaksi_pengeluaran')
                ->whereDate('tanggal', '<', $tanggal_mulai)
                ->sum('jumlah');
        }

        $saldo_awal = $total_pemasukan_sebelum - $total_pengeluaran_sebelum;

        // ============================
        // 2. AMBIL CASHFLOW PERIODE
        // ============================

        $queryPemasukanSelada = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"selada" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->whereIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                        ->whereRaw('LOWER(i.satuan) != "pack" AND LOWER(i.produk) = "selada"');
                })
                ->orWhere(function ($sub) {
                    $sub->whereNotIn('t.pelanggan', ['Aeon Mall', 'Istana Buah']);
                });
            })
            ->whereRaw('(LOWER(i.produk) = "selada")')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $queryPemasukanPackAeon = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"aeon" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where('t.pelanggan', 'Aeon Mall')
            ->where('i.satuan', 'Pack')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $queryPemasukanPackIstana = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"istana" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where('t.pelanggan', 'Istana Buah')
            ->where('i.satuan', 'Pack')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $queryPemasukanLainnya = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi as tanggal',
                DB::raw('"lainnya" as deskripsi'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as total_jumlah'),
                DB::raw('"pemasukan" as kategori')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->whereIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                        ->whereRaw('LOWER(i.satuan) != "pack"');
                })
                ->orWhere(function ($sub) {
                    $sub->whereNotIn('t.pelanggan', ['Aeon Mall', 'Istana Buah']);
                });
            })
            ->whereRaw('NOT (LOWER(i.produk) = "selada")')
            ->groupBy('t.tanggal_transaksi')
            ->orderBy('t.tanggal_transaksi', 'asc');


        $pengeluaran = DB::table('transaksi_pengeluaran')
                        ->select(
                            'tanggal',
                            'jenis_pengeluaran as deskripsi',
                            DB::raw('SUM(jumlah) as total_jumlah'),
                            DB::raw('"pengeluaran" as kategori')
                        )
                        ->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])
                        ->groupBy('tanggal', 'jenis_pengeluaran');

        
        $data = $queryPemasukanSelada
                ->unionAll($queryPemasukanPackAeon)
                ->unionAll($queryPemasukanPackIstana)
                ->unionAll($queryPemasukanLainnya)
                ->unionAll($pengeluaran)
                ->orderBy('tanggal', 'asc')
                ->get();


        $dataGrouped = $data->groupBy('tanggal');


        // ============================
        // RETURN DATA KE VIEW
        // ============================

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('pages.keuangan.cashflow.cetak', [
            "title" => 'Laporan Cashflow',
            'tanggal_hari_ini' => $today,
            "saldo_awal" => $saldo_awal,
            "data" => $dataGrouped,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
        ]));
        $mpdf->Output('Laporan_Cashflow_' . $tanggal_mulai . '_sampai_' . $tanggal_akhir . '.pdf', \Mpdf\Output\Destination::INLINE);
    }
    

    // public function labaRugi(Request $request)
    // {
    //     Carbon::setLocale('id');
    //     $today = Carbon::now()->translatedFormat('d F Y');
    //     $tanggal_mulai = $request->tanggal_mulai;
    //     $tanggal_akhir = $request->tanggal_akhir;
    //     $tanggal = now()->toDateString();

    //     $dataPemasukan = DB::table('item_pemasukan as i')
    //         ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
    //         ->select(
    //             'i.produk',
    //             'i.satuan',
    //             DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
    //         )->whereBetween(
    //             't.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir]
    //         )->groupBy(
    //             'i.produk', 
    //             'i.satuan'
    //         )->orderBy('i.produk', 'asc')->get();


    //     $totalOmsetPemasukan = $dataPemasukan->sum('omset');

        

    //     $dataPengeluaran = DB::table('transaksi_pengeluaran as t')
    //         ->select(
    //             't.jenis_pengeluaran',
    //             DB::raw('SUM(t.jumlah) as total_pengeluaran')
    //         )
    //         ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
    //         ->groupBy('t.jenis_pengeluaran')
    //         ->orderBy('t.jenis_pengeluaran', 'asc')
    //         ->get();

    //     $totalPengeluaran = $dataPengeluaran->sum('total_pengeluaran');

    //     $total =  $totalOmsetPemasukan - $totalPengeluaran;

    //     return view('pages.keuangan.labaRugi.index', [
    //         'title' => 'Laporan Laba Rugi',
    //         'tanggal_hari_ini' => $today,
    //         'tanggal' => $tanggal,
    //         'pemasukan' => $dataPemasukan,
    //         'total_omset_pemasukan' => $totalOmsetPemasukan,
    //         'pengeluaran' => $dataPengeluaran,
    //         'total_pengeluaran' => $totalPengeluaran,
    //         'total' => $total
    //     ]);
    // }

    
    public function labaRugi(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        $tanggal = now()->toDateString();

        // $dataPemasukan = DB::table('item_pemasukan as i')
        //     ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
        //     ->select(
        //         'i.produk',
        //         'i.satuan',
        //         DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
        //     )->whereBetween(
        //         't.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir]
        //     )->groupBy(
        //         'i.produk', 
        //         'i.satuan',
        //     )->orderBy('i.produk', 'asc')->get();

        
        $queryPemasukan = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                'i.produk',
                'i.satuan',
                't.pelanggan',
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )->whereBetween(
                't.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir]
            )->groupBy(
                'i.produk', 
                'i.satuan',
                't.pelanggan'
            )->orderBy('i.produk', 'asc');

        // Selada non-pack
        $dataSelada = $queryPemasukan->get()->filter(function ($item) {
            return strtolower($item->produk) === 'selada' 
            && !(strtolower($item->satuan) === 'pack'&& in_array($item->pelanggan, ['Aeon Mall', 'Istana Buah']));
        });
        $totalSeladaOmset = $dataSelada->sum('omset');

        // Aeon Mall
        $queryAeonPack = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi',
                'i.produk',
                'i.satuan',
                DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )
            ->where('pelanggan', 'Aeon Mall')
            ->where('i.satuan', 'Pack')
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
            ->orderBy('t.tanggal_transaksi', 'asc');
        
        $dataAeon = $queryAeonPack->get();
        $totalAeonOmset = $dataAeon->sum('omset');

        // Istana Buah
        $queryIstanaPack = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi',
                'i.produk',
                'i.satuan',
                DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )
            ->where('pelanggan', 'Istana Buah')
            ->where('i.satuan', 'Pack')
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
            ->orderBy('t.tanggal_transaksi', 'asc');
        
        $dataIstana = $queryIstanaPack->get();
        $totalIstanaOmset = $dataIstana->sum('omset');

        $queryLainnya = DB::table('item_pemasukan as i')
                    ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
                    ->select(
                        't.tanggal_transaksi',
                        'i.produk',
                        'i.satuan',
                        DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                        DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
                    )
                    ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])

                    ->where(function ($q) {
                        // Rule 1: pelanggan AEON / IB → satuan != pack
                        $q->where(function ($sub) {
                            $sub->whereIn('pelanggan', ['Aeon Mall', 'Istana Buah'])
                                ->whereRaw('LOWER(i.satuan) != "pack"');
                        })
                        // Rule 2: pelanggan lain → ambil semua satuan
                        ->orWhere(function ($sub) {
                            $sub->whereNotIn('pelanggan', ['Aeon Mall', 'Istana Buah']);
                        });
                    })

                    // Rule 3: pengecualian selada satuan kg
                    ->whereRaw('NOT (LOWER(i.produk) = "selada")')

                    ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
                    ->orderBy('t.tanggal_transaksi', 'asc');


        // Rekap Penjualan Lainnya
        $dataLainnya = $queryLainnya->get();
        $totalLainnyaOmset = $dataLainnya->sum('omset');

        $dataPemasukan = $queryPemasukan->get();
        $totalOmsetPemasukan = $dataPemasukan->sum('omset');

        $dataPengeluaran = DB::table('transaksi_pengeluaran as t')
            ->select(
                't.jenis_pengeluaran',
                DB::raw('SUM(t.jumlah) as total_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.jenis_pengeluaran')
            ->orderBy('t.jenis_pengeluaran', 'asc')
            ->get();

        $totalPengeluaran = $dataPengeluaran->sum('total_pengeluaran');

        $total =  $totalOmsetPemasukan - $totalPengeluaran;

        return view('pages.keuangan.labaRugi.index', [
            'title' => 'Laporan Laba Rugi',
            'tanggal_hari_ini' => $today,
            'tanggal' => $tanggal,
            // 'pemasukan' => $dataPemasukan,
            'total_selada_omset' => $totalSeladaOmset,
            'total_aeon_omset' => $totalAeonOmset,
            'total_istana_omset' => $totalIstanaOmset,
            'total_lainnya_omset' => $totalLainnyaOmset,
            'total_omset_pemasukan' => $totalOmsetPemasukan,
            'pengeluaran' => $dataPengeluaran,
            'total_pengeluaran' => $totalPengeluaran,
            'total' => $total
        ]);
    }

    public function cetakLabaRugi(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;

        // $dataPemasukan = DB::table('item_pemasukan as i')
        //     ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
        //     ->select(
        //         'i.produk',
        //         'i.satuan',
        //         DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
        //     )->whereBetween(
        //         't.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir]
        //     )->groupBy(
        //         'i.produk', 
        //         'i.satuan'
        //     )->orderBy('i.produk', 'asc')->get();


        $queryPemasukan = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                'i.produk',
                'i.satuan',
                't.pelanggan',
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )->whereBetween(
                't.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir]
            )->groupBy(
                'i.produk', 
                'i.satuan',
                't.pelanggan'
            )->orderBy('i.produk', 'asc');

        // Selada non-pack
        $dataSelada = $queryPemasukan->get()->filter(function ($item) {
            return strtolower($item->produk) === 'selada' 
            && !(strtolower($item->satuan) === 'pack'&& in_array($item->pelanggan, ['Aeon Mall', 'Istana Buah']));
        });
        $totalSeladaOmset = $dataSelada->sum('omset');

        // Aeon Mall
        $queryAeonPack = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi',
                'i.produk',
                'i.satuan',
                DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )
            ->where('pelanggan', 'Aeon Mall')
            ->where('i.satuan', 'Pack')
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
            ->orderBy('t.tanggal_transaksi', 'asc');
        
        $dataAeon = $queryAeonPack->get();
        $totalAeonOmset = $dataAeon->sum('omset');

        // Istana Buah
        $queryIstanaPack = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi',
                'i.produk',
                'i.satuan',
                DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )
            ->where('pelanggan', 'Istana Buah')
            ->where('i.satuan', 'Pack')
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
            ->orderBy('t.tanggal_transaksi', 'asc');
        
        $dataIstana = $queryIstanaPack->get();
        $totalIstanaOmset = $dataIstana->sum('omset');

        $queryLainnya = DB::table('item_pemasukan as i')
                    ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
                    ->select(
                        't.tanggal_transaksi',
                        'i.produk',
                        'i.satuan',
                        DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                        DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
                    )
                    ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])

                    ->where(function ($q) {
                        // Rule 1: pelanggan AEON / IB → satuan != pack
                        $q->where(function ($sub) {
                            $sub->whereIn('pelanggan', ['Aeon Mall', 'Istana Buah'])
                                ->whereRaw('LOWER(i.satuan) != "pack"');
                        })
                        // Rule 2: pelanggan lain → ambil semua satuan
                        ->orWhere(function ($sub) {
                            $sub->whereNotIn('pelanggan', ['Aeon Mall', 'Istana Buah']);
                        });
                    })

                    // Rule 3: pengecualian selada satuan kg
                    ->whereRaw('NOT (LOWER(i.produk) = "selada")')

                    ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
                    ->orderBy('t.tanggal_transaksi', 'asc');


        // Rekap Penjualan Lainnya
        $dataLainnya = $queryLainnya->get();
        $totalLainnyaOmset = $dataLainnya->sum('omset');

        $dataPemasukan = $queryPemasukan->get();
        $totalOmsetPemasukan = $dataPemasukan->sum('omset');

        $dataPengeluaran = DB::table('transaksi_pengeluaran as t')
            ->select(
                't.jenis_pengeluaran',
                DB::raw('SUM(t.jumlah) as total_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.jenis_pengeluaran')
            ->orderBy('t.jenis_pengeluaran', 'asc')
            ->get();

        $totalPengeluaran = $dataPengeluaran->sum('total_pengeluaran');

        $total =  $totalOmsetPemasukan - $totalPengeluaran;
        
       $html = view('pages.keuangan.labaRugi.cetak', [
            'title' => 'Laporan Laba Rugi',
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            // 'pemasukan' => $dataPemasukan,
            'total_selada_omset' => $totalSeladaOmset,
            'total_aeon_omset' => $totalAeonOmset,
            'total_istana_omset' => $totalIstanaOmset,
            'total_lainnya_omset' => $totalLainnyaOmset,
            'total_omset_pemasukan' => $totalOmsetPemasukan,
            'pengeluaran' => $dataPengeluaran,
            'pengeluaran_total' => $totalPengeluaran,
            'total' => $total
       ])->render();

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);

        $mpdf->Output(
            'Laporan_Laba_Rugi_' . $tanggal_mulai . '_sampai_' . $tanggal_akhir . '.pdf',
            \Mpdf\Output\Destination::INLINE
        );

    }

   
}
