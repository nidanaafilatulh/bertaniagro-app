<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapPengeluaranController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        $tanggal = now()->toDateString();


        // Group total per jenis pengeluaran
        $dataJenisPengeluaran = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                DB::raw('SUM(t.jumlah) as total_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama')
            ->orderBy('j.nama', 'asc')
            ->get();

        // Group item per jenis_pengeluaran
        $dataItem = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                'i.nama as nama_item',
                DB::raw('SUM(t.kuantitas) as total_kuantitas'),
                't.harga_per_item',
                DB::raw('SUM(t.jumlah) as item_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama', 'i.nama', 't.harga_per_item')
            ->orderBy('i.nama', 'asc')
            ->get()
            ->groupBy('jenis_pengeluaran');
        
        $dataJenisPengeluaranLain = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                DB::raw('SUM(t.jumlah) as total_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereNotIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama')
            ->orderBy('j.nama', 'asc')
            ->get();
        
        $dataItemLain = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                'i.nama as nama_item',
                DB::raw('SUM(t.jumlah) as item_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereNotIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama', 'i.nama')
            ->orderBy('i.nama', 'asc')
            ->get()
            ->groupBy('jenis_pengeluaran');

        
        $totalPengeluaran = $dataJenisPengeluaran->sum('total_pengeluaran') + $dataJenisPengeluaranLain->sum('total_pengeluaran');

        return view('pages.pengeluaran.rekap.index', [
            'title' => 'Rekap Pengeluaran',
            'tanggal_hari_ini' => $today,
            'tanggal' => $tanggal,
            'daftar_jenis' => $dataJenisPengeluaran,
            'daftar_item' => $dataItem,
            'daftar_jenis_lain' => $dataJenisPengeluaranLain,
            'daftar_item_lain' => $dataItemLain,
            'total_pengeluaran' => $totalPengeluaran
        ]);
    }

    public function cetak(Request $request)
    {
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;

        // Group total per jenis pengeluaran
        $dataJenisPengeluaran = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                DB::raw('SUM(t.jumlah) as total_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama')
            ->orderBy('j.nama', 'asc')
            ->get();

        // Group item per jenis_pengeluaran
        $dataItem = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                'i.nama as nama_item',
                DB::raw('SUM(t.kuantitas) as total_kuantitas'),
                't.harga_per_item',
                DB::raw('SUM(t.jumlah) as item_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama', 'i.nama', 't.harga_per_item')
            ->orderBy('i.nama', 'asc')
            ->get()
            ->groupBy('jenis_pengeluaran');
        
        $dataJenisPengeluaranLain = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                DB::raw('SUM(t.jumlah) as total_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereNotIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama')
            ->orderBy('j.nama', 'asc')
            ->get();
        
        $dataItemLain = DB::table('transaksi_pengeluaran as t')
            ->join('item_pengeluaran as i', 't.id_item', '=', 'i.id')
            ->join('jenis_pengeluaran as j', 'i.jenis_pengeluaran_id', '=', 'j.id')
            ->select(
                'j.nama as jenis_pengeluaran',
                'i.nama as nama_item',
                DB::raw('SUM(t.jumlah) as item_pengeluaran')
            )
            ->whereBetween('t.tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->whereNotIn('j.nama', ['Gaji Karyawan', 'Nutrisi', 'Rockwool', 'Kulakan', 'Listrik', 'Benih'])
            ->groupBy('j.nama', 'i.nama')
            ->orderBy('i.nama', 'asc')
            ->get()
            ->groupBy('jenis_pengeluaran');

        
        $totalPengeluaran = $dataJenisPengeluaran->sum('total_pengeluaran') + $dataJenisPengeluaranLain->sum('total_pengeluaran');

        $rentang_mulai = Carbon::parse($tanggal_mulai)->translatedFormat('d F Y');
        $rentang_akhir = Carbon::parse($tanggal_akhir)->translatedFormat('d F Y');

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('pages.pengeluaran.rekap.cetak', [
            'title' => 'Rekap Pengeluaran',
            'tanggal_hari_ini' => $today,
            'daftar_jenis' => $dataJenisPengeluaran,
            'daftar_item' => $dataItem,
            'daftar_jenis_lain' => $dataJenisPengeluaranLain,
            'daftar_item_lain' => $dataItemLain,
            'total_pengeluaran' => $totalPengeluaran,
            'tanggal_mulai' => $rentang_mulai,
            'tanggal_akhir' => $rentang_akhir,
        ]));
        $mpdf->Output('Rekap_Pengeluaran_' . $tanggal_mulai . '_sampai_' . $tanggal_akhir . '.pdf', \Mpdf\Output\Destination::INLINE);
    }

}
