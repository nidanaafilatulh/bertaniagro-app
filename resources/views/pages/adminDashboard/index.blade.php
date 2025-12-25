@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Selamat Datang Admin Bertani Agrofarm
                    </h2>
                    <div class="page-pretitle">
                        {{ $tanggal_hari_ini }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3 justify-content-center">
                <!-- Card Pemasukan -->
                <div class="col-md-6">
                    <a href="/pemasukan/create" class="text-decoration-none">
                        <div class="card" style="height: 180px;">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-checkup-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 14h.01" />
                                            <path d="M9 17h.01" />
                                            <path d="M12 16l1 1l3 -3" />
                                        </svg>
                                    </span>
                                    <div class="h2 mb-0">Catat Transaksi Pemasukan</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card Pengeluaran -->
                <div class="col-md-6">
                    <a href="/pengeluaran/create" class="text-decoration-none">
                        <div class="card" style="height: 180px;">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-checkup-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 14h.01" />
                                            <path d="M9 17h.01" />
                                            <path d="M12 16l1 1l3 -3" />
                                        </svg>
                                    </span>
                                    <div class="h2 mb-0">Catat Transaksi Pengeluaran</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pemesanan Produk Hari Ini</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <form method="GET" id="showForm">
                                <div class="text-secondary d-flex align-items-center">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="number" name="show" class="form-control form-control-sm"
                                            value="{{ request('show', 10) }}" size="3"
                                            onchange="document.getElementById('showForm').submit()">
                                    </div>
                                    entries
                                </div>
                            </form>
                            {{-- <div class="ms-auto text-secondary">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice"
                                        fdprocessedid="0ucw8">
                                </div>
                            </div> --}}
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar_pemasukan as $item)
                                <tr>
                                    <td><span
                                            class="text-secondary">{{ $daftar_pemasukan->firstItem() + $loop->index }}</span>
                                    </td>
                                    <td>
                                        {{ $item->pelanggan }}
                                    </td>
                                    <td>
                                        {{ $item->produk }}
                                    </td>
                                    <td>
                                        {{ $item->kuantitas }}
                                    </td>
                                    <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($item->bukti_bayar != null)
                                            <span class="badge bg-success me-1"></span>
                                            Lunas
                                        @else
                                            <span class="badge bg-danger me-1"></span>
                                            Hutang
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row g-2 justify-content-center justify-content-sm-between">
                            <div class="col-auto d-flex align-items-center">
                                <p class="m-0 text-secondary">
                                    Showing <strong>{{ $daftar_pemasukan->firstItem() }}</strong>
                                    to <strong>{{ $daftar_pemasukan->lastItem() }}</strong>
                                    of <strong>{{ $daftar_pemasukan->total() }}</strong> entries
                                </p>
                            </div>
                            <div class="col-auto">
                                {{ $daftar_pemasukan->links('vendor.pagination.tabler') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BODY -->
@endsection
