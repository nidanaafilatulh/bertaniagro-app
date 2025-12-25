<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OwnerDashboardController;
use App\Http\Controllers\RekapPemasukanController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\RekapPengeluaranController;
use App\Http\Controllers\PengeluaranController;

Route::get('/', [AuthenticationController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class,'index'])->name('owner.dashboard');

    Route::get('/rekap/pemasukan', [RekapPemasukanController::class, 'index']);
    Route::get('/rekap/pemasukan/cetak', [RekapPemasukanController::class, 'cetak']);
    Route::get('/rekap/pengeluaran', [RekapPengeluaranController::class, 'index']);
    Route::get('/rekap/pengeluaran/cetak', [RekapPengeluaranController::class, 'cetak']);

    
    Route::get('/keuangan/cashflow', [LaporanKeuanganController::class, 'cashflow']);
    Route::get('/keuangan/cashflow/cetak', [LaporanKeuanganController::class, 'cetakCashflow']);
    Route::get('/keuangan/laba-rugi', [LaporanKeuanganController::class, 'labaRugi']);
    Route::get('/keuangan/labaRugi/cetak', [LaporanKeuanganController::class, 'cetakLabaRugi']);
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/create/kumulatif/pemasukan', [PemasukanController::class, 'kumulatif']);
    Route::post('/create/kumulatif/pemasukan', [PemasukanController::class, 'storeKumulatif']);
    Route::resource('/pemasukan', PemasukanController::class);
    Route::get('/create/kumulatif/pengeluaran', [PengeluaranController::class, 'kumulatif']);
    Route::post('/create/kumulatif/pengeluaran', [PengeluaranController::class, 'storeKumulatif']);
    Route::resource('/pengeluaran', PengeluaranController::class);
});

// 'title' => 'Laporan Laba Rugi',
//             'tanggal_hari_ini' => $today,
//             'pemasukan' => $dataPemasukan,
//             'total_omset_pemasukan' => $totalOmsetPemasukan,
//             'pengeluaran' => $dataPengeluaran,
//             'total_pengeluaran' => $totalPengeluaran,
//             'total' => $total,





