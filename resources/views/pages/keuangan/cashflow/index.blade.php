@extends('layouts.pages-layouts')

@section('container')
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Laporan Keuangan
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
                        <h3 class="card-title">Laporan Cashflow</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex flex-wrap align-items-end justify-content-between">
                            <form method="GET" action="/keuangan/cashflow">
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
                            <a href="/keuangan/cashflow/cetak?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
                                target="_blank" class="btn btn-success mb-2">
                                <i class="ti ti-printer me-1"></i> Cetak Laporan
                            </a>
                        </div>
                    </div>
                    @if (request('tanggal_mulai') && request('tanggal_akhir'))
                        <div class="table-responsive">
                            <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">Tanggal
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/chevron-up -->
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-sm icon-thick icon-2">
                                                <path d="M6 15l6 -6l6 6"></path>
                                            </svg> --}}
                                        </th>
                                        <th>Deskripsi</th>
                                        <th>Uang Masuk</th>
                                        <th>Uang Keluar</th>
                                        <th>Saldo Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="text-secondary"></span></td>
                                        <td>
                                            Saldo Awal
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            @if ($saldo_awal == 0)
                                                0
                                            @else
                                                {{ number_format($saldo_awal, 0, ',', '.') }}
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $saldo = $saldo_awal;
                                    @endphp
                                    @foreach ($data as $tanggal => $items)
                                        @php $rowspan = count($items); @endphp

                                        @foreach ($items as $index => $item)
                                            <tr>
                                                @if ($index == 0)
                                                    <td rowspan="{{ $rowspan }}">
                                                        <span
                                                            class="text-secondary">{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($item->deskripsi === 'lainnya')
                                                        Penjualan Lainnya
                                                    @elseif ($item->deskripsi === 'selada')
                                                        Penjualan Selada
                                                    @elseif ($item->deskripsi === 'aeon')
                                                        Penjualan Sayur Pack Aeon
                                                    @elseif ($item->deskripsi === 'istana')
                                                        Penjualan Sayur Pack Istana Buah
                                                    @else
                                                        {{ $item->deskripsi }}
                                                    @endif
                                                </td>
                                                @if ($item->kategori === 'pemasukan')
                                                    <td>
                                                        Rp {{ number_format($item->total_jumlah, 0, ',', '.') }}
                                                    </td>
                                                    <td>

                                                    </td>
                                                @elseif($item->kategori === 'pengeluaran')
                                                    <td>

                                                    </td>
                                                    <td>
                                                        Rp {{ number_format($item->total_jumlah, 0, ',', '.') }}
                                                    </td>
                                                @else
                                                    <td>

                                                    </td>
                                                    <td>

                                                    </td>
                                                @endif
                                                <td>
                                                    @if ($item->kategori === 'pemasukan')
                                                        @php
                                                            $saldo += $item->total_jumlah;
                                                        @endphp
                                                    @elseif ($item->kategori === 'pengeluaran')
                                                        @php
                                                            $saldo -= $item->total_jumlah;
                                                        @endphp
                                                    @endif
                                                    Rp {{ number_format($saldo, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr class="fw-bold bg-light">
                                        <td colspan="4">Saldo Akhir</td>
                                        <td>Rp {{ number_format($saldo, 0, ',', '.') }}</td>
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
