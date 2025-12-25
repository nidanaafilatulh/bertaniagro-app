<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $today = Carbon::now();
        $hari_ini = $today->translatedFormat('d F Y');
        $show = request('show', 10);

        $query = DB::table('item_pemasukan as i')
            ->join('transaksi_pemasukan as t', 'i.no_transaksi', '=', 't.no_transaksi')
            ->select(
                't.pelanggan',
                'i.produk',
                'i.kuantitas',
                'i.satuan',
                'i.harga_satuan',
                't.bukti_bayar',
                DB::raw('(i.kuantitas * i.harga_satuan) as jumlah')
            )
            ->whereDate('t.tanggal_transaksi', $today->toDateString()) // FIXED
            ->orderBy('t.pelanggan', 'asc');

        // paginate query (not the final collection)
        $data = $query->paginate($show)->withQueryString();

        return view('pages.adminDashboard.index', [
            'title' => 'Owner Dashboard',
            'tanggal_hari_ini' => $hari_ini,
            'daftar_pemasukan' => $data
        ]);
    }
}
