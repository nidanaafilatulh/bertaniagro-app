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
                        <h3 class="card-title">Laporan Laba Rugi</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex flex-wrap align-items-end justify-content-between">
                            <form method="GET" action="/keuangan/laba-rugi">
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
                            <a href="/keuangan/labaRugi/cetak?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
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
                                        <th colspan="2">Pemasukan</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="text-secondary">Penjualan Selada</span></td>
                                        <td>
                                            Rp {{ number_format($total_selada_omset, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Penjualan Sayur Pack Aeon</span></td>
                                        <td>
                                            Rp {{ number_format($total_aeon_omset, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Penjualan Sayur Pack Istana Buah</span></td>
                                        <td>
                                            Rp {{ number_format($total_istana_omset, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-secondary">Penjualan Lainnya</span></td>
                                        <td>
                                            Rp {{ number_format($total_lainnya_omset, 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    {{-- @foreach ($pemasukan as $item_pemasukan)
                                        <tr>
                                            <td><span class="text-secondary">{{ $item_pemasukan->produk }}
                                                    ({{ $item_pemasukan->satuan }})
                                                </span></td>
                                            <td>
                                                Rp {{ number_format($item_pemasukan->omset, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    <tr class="fw-bold bg-light">
                                        <td>Total Pemasukan</td>
                                        <td>Rp {{ number_format($total_omset_pemasukan, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="2">Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengeluaran as $item_pengeluaran)
                                        <tr>
                                            <td><span
                                                    class="text-secondary">{{ $item_pengeluaran->jenis_pengeluaran }}</span>
                                            </td>
                                            <td>
                                                Rp {{ number_format($item_pengeluaran->total_pengeluaran, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="fw-bold bg-light">
                                        <td>Total Pengeluaran</td>
                                        <td>Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="fw-bold bg-light">
                                        @if ($total < 0)
                                            <td>Rugi</td>
                                            <td class="text-red">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                        @elseif($total > 0)
                                            <td>Laba</td>
                                            <td class="text-green">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                        @else
                                            <td>Total</td>
                                            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                                        @endif
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
