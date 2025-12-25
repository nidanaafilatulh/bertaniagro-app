<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        Carbon::setLocale('id');
        $today = Carbon::now()->translatedFormat('d F Y');

            // --- LAST 30 DAYS DATE RANGE ---
        $tanggal_mulai = $request->tanggal_mulai ?? now()->subDays(29)->toDateString();
        $tanggal_akhir = $request->tanggal_akhir ?? now()->toDateString();


        // === PEMASUKAN ===
        $pemasukan = DB::table('transaksi_pemasukan')
            ->select(
                DB::raw('tanggal_transaksi AS tanggal'),
                DB::raw('SUM(jumlah) AS total')
            )
            ->whereBetween('tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('tanggal_transaksi')
            ->orderBy('tanggal_transaksi')
            ->get()
            ->pluck('total', 'tanggal')
            ->toArray();

        // === PENGELUARAN ===
        $pengeluaran = DB::table('transaksi_pengeluaran')
            ->select(
                DB::raw('tanggal AS tanggal'),
                DB::raw('SUM(jumlah) AS total')
            )
            ->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get()
            ->pluck('total', 'tanggal')
            ->toArray();


        // --- GENERATE 30 DAYS LABELS ---
        $start = Carbon::parse($tanggal_mulai);
        $end = Carbon::parse($tanggal_akhir);

        $labels = [];
        $dataPemasukan = [];
        $dataPengeluaran = [];
        $dataLabaRugi = [];

        for ($date = $start; $date <= $end; $date->addDay()) {
            $d = $date->format('Y-m-d');
            $labels[] = $d;

            $dataPemasukan[] = $pemasukan[$d] ?? 0;
            $dataPengeluaran[] = $pengeluaran[$d] ?? 0;
            $dataLabaRugi[] = ($pemasukan[$d] ?? 0) - ($pengeluaran[$d] ?? 0);
        }

        $totalPemasukan = DB::table('transaksi_pemasukan')
        ->whereBetween('tanggal_transaksi', [$tanggal_mulai, $tanggal_akhir])
        ->sum('jumlah');

        $totalPengeluaran = DB::table('transaksi_pengeluaran')
        ->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])
        ->sum('jumlah');

        $labaRugi = $totalPemasukan - $totalPengeluaran;

        return view('pages.ownerDashboard.index', [
            'title' => 'Owner Dashboard',
            'user' => $user,
            'tanggal_hari_ini' => $today,
            'labels' => $labels,
            'pemasukan_chart' => $dataPemasukan,
            'pengeluaran_chart' => $dataPengeluaran,
            'labaRugi_chart' => $dataLabaRugi,
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaRugi' => $labaRugi,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
        ]);
    } 
}
