@extends('layouts.pages-layouts')

@section('container')
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Pengeluaran
                    </h2>
                    <div class="page-pretitle">
                        {{ $tanggal_hari_ini }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rekap Pengeluaran</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex flex-wrap align-items-end justify-content-between">
                            <form method="GET" action="/rekap/pengeluaran">
                                <div class="d-flex align-items-end">
                                    <div class="me-2 mb-2">
                                        <label class="form-label fw-semibold mb-1">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control"
                                            value="{{ request('tanggal_mulai') }}" required>
                                    </div>
                                    <div class="me-2 mb-2">
                                        <label class="form-label fw-semibold mb-1">Tanggal Akhir</label>
                                        <input type="date" name="tanggal_akhir" class="form-control"
                                            value="{{ request('tanggal_akhir', $tanggal) }}" required>
                                    </div>
                                    <div class="mb-2">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <a href="/rekap/pengeluaran/cetak?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                                target="_blank" class="btn btn-success mb-2">
                                <i class="ti ti-printer me-1"></i> Cetak Rekap
                            </a>
                        </div>
                    </div>
                    @if (request('tanggal_mulai') && request('tanggal_akhir'))
                        <div class="table-responsive">
                            <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Beban</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftar_jenis as $jenis)
                                        <tr data-bs-toggle="collapse"
                                            data-bs-target="#{{ Str::slug($jenis->jenis_pengeluaran) }}"
                                            class="cursor-pointer">
                                            <td colspan="3">
                                                <span class="dropdown-toggle">{{ $jenis->jenis_pengeluaran }}</span>
                                            </td>
                                            <td>Rp {{ number_format($jenis->total_pengeluaran, 0, ',', '.') }}</td>
                                        </tr>
                                        @foreach ($daftar_item[$jenis->jenis_pengeluaran] ?? [] as $item)
                                            <tr class="collapse bg-light" id="{{ Str::slug($jenis->jenis_pengeluaran) }}">
                                                <td class="ps-5">{{ $item->nama_item }}</td>
                                                <td>
                                                    @if (fmod($item->total_kuantitas, 1) == 0)
                                                        {{ number_format($item->total_kuantitas, 0, ',', '.') }}
                                                    @else
                                                        {{ number_format($item->total_kuantitas, 2, ',', '.') }}
                                                    @endif
                                                </td>
                                                <td>Rp {{ number_format($item->harga_per_item, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($item->item_pengeluaran, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    @foreach ($daftar_jenis_lain as $jenis)
                                        <tr data-bs-toggle="collapse"
                                            data-bs-target="#{{ Str::slug($jenis->jenis_pengeluaran) }}"
                                            class="cursor-pointer">
                                            <td colspan="3">
                                                <span class="dropdown-toggle">{{ $jenis->jenis_pengeluaran }}</span>
                                            </td>
                                            <td>Rp {{ number_format($jenis->total_pengeluaran, 0, ',', '.') }}</td>
                                        </tr>
                                        @foreach ($daftar_item_lain[$jenis->jenis_pengeluaran] ?? [] as $item)
                                            <tr class="collapse bg-light" id="{{ Str::slug($jenis->jenis_pengeluaran) }}">
                                                <td colspan="3" class="ps-5">{{ $item->nama_item }}</td>
                                                <td>Rp {{ number_format($item->item_pengeluaran, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr class="fw-bold bg-light">
                                        <td>Total Pengeluaran</td>
                                        <td></td>
                                        <td></td>
                                        <td>Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
