@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <a href="/pemasukan">Kembali</a>
                    </div>
                    <h2 class="page-title">
                        Detail Transaksi Pemasukan
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Detail Transaksi No {{ $pemasukan->no_transaksi }}
                            @if ($pemasukan->bukti_bayar !== null)
                                <span class="badge bg-success ms-2 text-white">Lunas</span>
                            @else
                                <span class="badge bg-danger ms-2 text-white">Hutang</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <form class="space-y">
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label class="form-label">
                                        Pelanggan
                                    </label>
                                    <input type="text" placeholder="Masukkan nama pelanggan" class="form-control"
                                        value="{{ $pemasukan->pelanggan }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">
                                        Tanggal Transaksi Pemasukan
                                    </label>
                                    <input type="date" placeholder="Pilih tanggal" class="form-control"
                                        value="{{ $pemasukan->tanggal_transaksi }}" disabled>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3">
                                    <label class="form-label">
                                        Produk
                                    </label>
                                    <input type="text" class="form-control"
                                        value="{{ $pemasukan->itemPemasukan[0]->produk }}" disabled>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">
                                        Kuantias
                                    </label>
                                    <input type="number" step="0.01" class="form-control" value="{{ $pemasukan->itemPemasukan[0]->kuantitas}}" disabled>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">
                                        Satuan
                                    </label>
                                    <input type="text" class="form-control"
                                        value="{{ $pemasukan->itemPemasukan[0]->satuan }}" disabled>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">
                                        Harga Satuan
                                    </label>
                                    <input type="text" class="form-control"
                                        value="Rp {{ number_format($pemasukan->itemPemasukan[0]->harga_satuan, 0, ',', '.') }}"
                                        disabled>
                                </div>
                                <div class="col-3">
                                    <label class="form-label">
                                        Total Harga
                                    </label>
                                    <input type="text" class="form-control"
                                        value="Rp {{ number_format($pemasukan->itemPemasukan[0]->harga_satuan * $pemasukan->itemPemasukan[0]->kuantitas, 0, ',', '.') }}"
                                        disabled>
                                </div>
                            </div>
                            @foreach ($pemasukan->itemPemasukan->skip(1) as $item)
                                <div class="row">
                                    <div class="col-3">
                                        <input type="text" class="form-control" value="{{ $item->produk }}" disabled>
                                    </div>
                                    <div class="col-2">
                                        <input type="number"class="form-control" value="{{ $item->kuantitas }}" disabled>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" value="{{ $item->satuan }}" disabled>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" value="Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}"
                                            disabled>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control"
                                            value=" Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}"
                                            disabled>
                                    </div>
                                </div>
                            @endforeach
                            @if ($pemasukan->bukti_bayar != null)
                                <div class="row mt-3">
                                    <label class="form-label">
                                        Bukti Bayar
                                    </label>
                                    <div col-1>
                                        <a href="{{ asset('storage/bukti_bayar/' . $pemasukan->bukti_bayar) }}" download
                                            class="btn btn-primary mt-2">
                                            Download File
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="row mt-3">
                                    <label class="form-label">
                                        Bukti Bayar
                                    </label>
                                    <div class="alert alert-warning mt-2 ms-2" role="alert">
                                        Belum ada bukti bayar yang diunggah.
                                    </div>
                                </div>
                            @endif
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <label class="form-label d-flex">
                                        <h2>Total Keseluruhan: <span
                                                class="ms-3">Rp {{ number_format($pemasukan->itemPemasukan->sum(function ($item) {
                                                    return $item->harga_satuan * $item->kuantitas;
                                                }), 0, ',', '.') }}</span>
                                        </h2>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BODY -->
@endsection
