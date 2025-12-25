<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RekapPemasukanController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');

        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        $tanggal = now()->toDateString();

        $query = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi',
                'i.produk',
                'i.satuan',
                DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
            ->orderBy('t.tanggal_transaksi', 'asc');

        $data = $query->get();

        // ⭐ Group by date for rowspan
        $grouped = $data->groupBy('tanggal_transaksi');

        // ⭐ Total omset harian per tanggal
        $totalOmsetHarian = $grouped->map(function ($rows) {
            return $rows->sum('omset');
        });

        // Selada
        $querySelada = DB::table('item_pemasukan as i')
                        ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
                        ->select(
                            't.tanggal_transaksi',
                            'i.produk',
                            'i.satuan',
                            DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                            DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
                        )
                        ->where(function ($q) {
                            // Rule 1: pelanggan AEON / IB → satuan != pack + produk selada
                            $q->where(function ($sub) {
                                $sub->whereIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                                    ->whereRaw('LOWER(i.satuan) != "pack"')
                                    ->whereRaw('LOWER(i.produk) = "selada"');
                            })

                            // Rule 2: pelanggan lain → ambil semua satuan (tetap produk selada)
                            ->orWhere(function ($sub) {
                                $sub->whereNotIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                                    ->whereRaw('LOWER(i.produk) = "selada"');
                            });
                        })
                        ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
                        ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
                        ->orderBy('t.tanggal_transaksi', 'asc');

        // Rekap Penjualan Selada Kg-an
        $dataSelada = $querySelada->get();
        $groupedSelada = $dataSelada->groupBy('tanggal_transaksi');

        // Rekap Penjualan Selada Kg-an
        $rekapSelada = $groupedSelada->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });

        // Rekap Aeon Mall (Pack)
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
        $groupedAeon = $dataAeon->groupBy('tanggal_transaksi');

        // ⭐ Data khusus Aeon
        $rekapAeon = $groupedAeon->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });

        // Rekap Istana Buah (Pack)
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
        $groupedIstana = $dataIstana->groupBy('tanggal_transaksi');

        // ⭐ Data khusus Istana Buah
        $rekapIstana = $groupedIstana->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });
        // Query untuk Rekap Lainnya
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
                    ->whereRaw('NOT(LOWER(i.produk) = "selada")')

                    ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
                    ->orderBy('t.tanggal_transaksi', 'asc');


        // Rekap Penjualan Lainnya
        $dataLainnya = $queryLainnya->get();
        $groupedLainnya = $dataLainnya->groupBy('tanggal_transaksi');

        //Rekap Akhir 
        // Selada Kg-an
        $groupedSeladaAkhir = $dataSelada->groupBy('satuan');

        // Total Kuantitas per satuan
        $rekapSeladaAkhir = $groupedSeladaAkhir->map(function ($items) {
            return [
                'total_kuantitas' => $items->sum('total_kuantitas'),
                'total_omset'      => $items->sum('omset'),
            ];
        });
        $total_pemasukan_selada = $dataSelada->sum('omset');

        // Aeon
        $groupedAeonAkhir = $dataAeon->groupBy('satuan');
        // Total Kuantitas per satuan
        $rekapAeonAkhir = $groupedAeonAkhir->map(function ($items) {
            return [
                'total_kuantitas' => $items->sum('total_kuantitas'),
                'total_omset'      => $items->sum('omset'),
            ];
        });

        // Istana
        $groupedIstanaAkhir = $dataIstana->groupBy('satuan');
        // Total Kuantitas per satuan
        $rekapIstanaAkhir = $groupedIstanaAkhir->map(function ($items) {
            return [
                'total_kuantitas' => $items->sum('total_kuantitas'),
                'total_omset'      => $items->sum('omset'),
            ];
        });

        // Lainnya
        $groupedLainnyaAkhir = $dataLainnya->groupBy('produk');
        // Total Kuantitas per satuan
        $rekapLainnyaAkhir = $groupedLainnyaAkhir->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });
        // Total pemasukan lainnya
        $total_pemasukan_lainnya = $dataLainnya->sum('omset');
        // ⭐ Total pemasukan keseluruhan
        $totalPemasukan = $data->sum('omset');


        return view('pages.pemasukan.rekap.index', [
            'title' => 'Rekap Pemasukan',
            'grouped' => $grouped,
            'rekap_selada' => $rekapSelada,
            'rekap_aeon' => $rekapAeon,
            'rekap_istana' => $rekapIstana,
            'rekap_lainnya' => $groupedLainnya,
            'rekap_selada_akhir' => $rekapSeladaAkhir,
            'total_pemasukan_selada' => $total_pemasukan_selada,
            'rekap_aeon_akhir' => $rekapAeonAkhir,
            'rekap_istana_akhir' => $rekapIstanaAkhir,
            'rekap_lainnya_akhir' => $rekapLainnyaAkhir,
            'total_pemasukan_lainnya' => $total_pemasukan_lainnya,
            'total_omset_harian' => $totalOmsetHarian,
            'tanggal_hari_ini' => $today,
            'tanggal' => $tanggal,
            'total_pemasukan' => $totalPemasukan,
        ]);
    }


    public function cetak(Request $request)
    {
        Carbon::setLocale('id');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;

        $query = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.tanggal_transaksi',
                'i.produk',
                'i.satuan',
                DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
            )
            ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
            ->orderBy('t.tanggal_transaksi', 'asc');
        $data = $query->get();
        // ⭐ Group by date for rowspan
        $grouped = $data->groupBy('tanggal_transaksi');
        

        $totalOmsetHarian = $grouped->map(function ($rows) {
            return $rows->sum('omset');
        });

        // Selada
        $querySelada = DB::table('item_pemasukan as i')
                        ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
                        ->select(
                            't.tanggal_transaksi',
                            'i.produk',
                            'i.satuan',
                            DB::raw('SUM(i.kuantitas) as total_kuantitas'),
                            DB::raw('SUM(i.kuantitas * i.harga_satuan) as omset')
                        )
                        ->where(function ($q) {
                            // Rule 1: pelanggan AEON / IB → satuan != pack + produk selada
                            $q->where(function ($sub) {
                                $sub->whereIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                                    ->whereRaw('LOWER(i.satuan) != "pack"')
                                    ->whereRaw('LOWER(i.produk) = "selada"');
                            })

                            // Rule 2: pelanggan lain → ambil semua satuan (tetap produk selada)
                            ->orWhere(function ($sub) {
                                $sub->whereNotIn('t.pelanggan', ['Aeon Mall', 'Istana Buah'])
                                    ->whereRaw('LOWER(i.produk) = "selada"');
                            });
                        })
                        ->whereBetween('t.tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
                        ->groupBy('t.tanggal_transaksi', 'i.produk', 'i.satuan')
                        ->orderBy('t.tanggal_transaksi', 'asc');

        // Rekap Penjualan Selada Kg-an
        $dataSelada = $querySelada->get();
        $groupedSelada = $dataSelada->groupBy('tanggal_transaksi');

        // Rekap Penjualan Selada Kg-an
        $rekapSelada = $groupedSelada->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });

        // Rekap Aeon Mall (Pack)
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
        $groupedAeon = $dataAeon->groupBy('tanggal_transaksi');

        // ⭐ Data khusus Aeon
        $rekapAeon = $groupedAeon->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });

        // Rekap Istana Buah (Pack)
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
        $groupedIstana = $dataIstana->groupBy('tanggal_transaksi');

        // ⭐ Data khusus Istana Buah
        $rekapIstana = $groupedIstana->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });
        // Query untuk Rekap Lainnya
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
        $groupedLainnya = $dataLainnya->groupBy('tanggal_transaksi');

        //Rekap Akhir 
        // Selada Kg-an
        $groupedSeladaAkhir = $dataSelada->groupBy('satuan');

        // Total Kuantitas per satuan
        $rekapSeladaAkhir = $groupedSeladaAkhir->map(function ($items) {
            return [
                'total_kuantitas' => $items->sum('total_kuantitas'),
                'total_omset'      => $items->sum('omset'),
            ];
        });
        $total_pemasukan_selada = $dataSelada->sum('omset');
        // Aeon
        $groupedAeonAkhir = $dataAeon->groupBy('satuan');
        // Total Kuantitas per satuan
        $rekapAeonAkhir = $groupedAeonAkhir->map(function ($items) {
            return [
                'total_kuantitas' => $items->sum('total_kuantitas'),
                'total_omset'      => $items->sum('omset'),
            ];
        });

        // Istana
        $groupedIstanaAkhir = $dataIstana->groupBy('satuan');
        // Total Kuantitas per satuan
        $rekapIstanaAkhir = $groupedIstanaAkhir->map(function ($items) {
            return [
                'total_kuantitas' => $items->sum('total_kuantitas'),
                'total_omset'      => $items->sum('omset'),
            ];
        });

        // Lainnya
        $groupedLainnyaAkhir = $dataLainnya->groupBy('produk');
        // Total Kuantitas per satuan
        $rekapLainnyaAkhir = $groupedLainnyaAkhir->map(function ($rows) {
            return $rows->groupBy('satuan')->map(function ($items) {
                return [
                    'total_kuantitas' => $items->sum('total_kuantitas'),
                    'total_omset'      => $items->sum('omset'),
                ];
            });
        });
        // Total pemasukan lainnya
        $total_pemasukan_lainnya = $dataLainnya->sum('omset');

        // // ⭐ Total kuantitas harian (group by satuan)
        // $totalKuantitasHarian = $grouped->map(function ($rows) {
        //     return $rows->groupBy('satuan')->map(function ($items) {
        //         return [
        //             'total_kuantitas' => $items->sum('total_kuantitas'),
        //             'total_omset'      => $items->sum('omset'),
        //         ];
        //     });
        // });

        // // ⭐ Group by satuan for rowspan
        // $groupedSatuan = $data->groupBy('satuan');

        // // Total Kuantitas per satuan
        // $totalKuantitasPerSatuan = $groupedSatuan->map(function ($items) {
        //     return [
        //         'total_kuantitas' => $items->sum('total_kuantitas'),
        //         'total_omset'      => $items->sum('omset'),
        //     ];
        // });

        $totalPemasukan = $data->sum('omset');

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('pages.pemasukan.rekap.cetak', [
            'grouped' => $grouped,
            'rekap_selada' => $rekapSelada,
            'rekap_aeon' => $rekapAeon,
            'rekap_istana' => $rekapIstana,
            'rekap_lainnya' => $groupedLainnya,
            'rekap_selada_akhir' => $rekapSeladaAkhir,
            'total_pemasukan_selada' => $total_pemasukan_selada,
            'rekap_aeon_akhir' => $rekapAeonAkhir,
            'rekap_istana_akhir' => $rekapIstanaAkhir,
            'rekap_lainnya_akhir' => $rekapLainnyaAkhir,
            'total_pemasukan_lainnya' => $total_pemasukan_lainnya,
            'total_pemasukan' => $totalPemasukan,
            'total_omset_harian' => $totalOmsetHarian,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir
        ]));
        $mpdf->Output('Rekap_Pemasukan_' . $tanggal_mulai . '_sampai_' . $tanggal_akhir . '.pdf', \Mpdf\Output\Destination::INLINE);
    }
}
