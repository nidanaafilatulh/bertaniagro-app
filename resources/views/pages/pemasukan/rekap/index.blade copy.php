@extends('layouts.pages-layouts')

@section('container')
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Pemasukan
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
                        <h3 class="card-title">Rekap Pemasukan</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex flex-wrap align-items-end justify-content-between">
                            <form method="GET" action="/rekap/pemasukan">
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
                                    <div class="d-flex align-items-end mb-2">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <a href="/rekap/pemasukan/cetak?tanggal_mulai={{ request('tanggal_mulai') }}&tanggal_akhir={{ request('tanggal_akhir') }}"
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
                                        <th class="w-1">
                                            Tanggal
                                        </th>
                                        <th>Komoditas</th>
                                        <th>Kuantitas</th>
                                        <th>Omset</th>
                                        <th>Rekap</th>
                                        <th>Total Omset</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grouped as $tanggal => $items)
                                        @php $rowspan = count($items); @endphp

                                        @foreach ($items as $index => $item)
                                            <tr>

                                                @if ($index == 0)
                                                    <td rowspan="{{ $rowspan }}">
                                                        <span
                                                            class="text-secondary">{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</span>
                                                    </td>
                                                @endif

                                                <td>{{ $item->produk }}</td>

                                                <td>
                                                    @if (fmod($item->total_kuantitas, 1) == 0)
                                                        {{ number_format($item->total_kuantitas, 0, ',', '.') }}
                                                        {{ $item->satuan }}
                                                    @else
                                                        {{ number_format($item->total_kuantitas, 2, ',', '.') }}
                                                        {{ $item->satuan }}
                                                    @endif
                                                </td>
                                                <td>Rp {{ number_format($item->omset, 0, ',', '.') }}</td>
                                                @if ($index == 0)
                                                    <td rowspan="{{ $rowspan }}">
                                                        @foreach ($total_kuantitas_harian[$tanggal] as $satuan => $total)
                                                            @php
                                                                $qty = $total['total_kuantitas'];
                                                                $omset = $total['total_omset'];
                                                            @endphp

                                                            @if (fmod($qty, 1) == 0)
                                                                <div>
                                                                    {{ number_format($qty, 0, ',', '.') }}
                                                                    {{ $satuan }}
                                                                    : Rp{{ number_format($omset, 0, ',', '.') }}
                                                                </div>
                                                            @else
                                                                <div>
                                                                    {{ number_format($qty, 2, ',', '.') }}
                                                                    {{ $satuan }}
                                                                    : Rp{{ number_format($omset, 0, ',', '.') }}
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endif

                                                @if ($index == 0)
                                                    <td rowspan="{{ $rowspan }}">
                                                        Rp
                                                        {{ number_format($total_omset_harian[$tanggal], 0, ',', '.') }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach

                                    <tr class="fw-bold bg-light">
                                        <td colspan="4">Total</td>
                                        <td>
                                            @foreach ($total_kuantitas_per_satuan as $satuan => $total)
                                                @php
                                                    $qty = $total['total_kuantitas'];
                                                    $omset = $total['total_omset'];
                                                @endphp

                                                @if (fmod($qty, 1) == 0)
                                                    <div>
                                                        {{ number_format($qty, 0, ',', '.') }} {{ $satuan }} : Rp
                                                        {{ number_format($omset, 0, ',', '.') }}
                                                    </div>
                                                @else
                                                    <div>
                                                        {{ number_format($qty, 2, ',', '.') }} {{ $satuan }} : Rp
                                                        {{ number_format($omset, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td>
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
