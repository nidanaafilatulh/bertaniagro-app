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
                                                        @if (isset($rekap_selada[$tanggal]))
                                                            @php
                                                                $total_selada = 0;
                                                            @endphp
                                                            <strong>Selada</strong>
                                                            @foreach ($rekap_selada[$tanggal] as $satuan => $total)
                                                                @php
                                                                    $qty = $total['total_kuantitas'];
                                                                    $omset = $total['total_omset'];
                                                                    $total_selada += $omset;
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
                                                            @if (count($rekap_selada[$tanggal]) > 1)
                                                                <div>
                                                                    <strong>Total Selada : Rp {{ number_format($total_selada, 0, ',', '.') }}</strong>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @if (isset($rekap_aeon[$tanggal]))
                                                            @foreach ($rekap_aeon[$tanggal] as $satuan => $total)
                                                                @php
                                                                    $qty = $total['total_kuantitas'];
                                                                    $omset = $total['total_omset'];
                                                                @endphp

                                                                @if (fmod($qty, 1) == 0)
                                                                    <div>
                                                                        <br> <strong>Sayur Pack Aeon</strong> <br>
                                                                        {{ number_format($qty, 0, ',', '.') }}
                                                                        {{ $satuan }}
                                                                        : Rp{{ number_format($omset, 0, ',', '.') }}
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <br> <strong>Sayur Pack Aeon</strong> <br>
                                                                        {{ number_format($qty, 2, ',', '.') }}
                                                                        {{ $satuan }}
                                                                        : Rp{{ number_format($omset, 0, ',', '.') }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if (isset($rekap_istana[$tanggal]))
                                                            @foreach ($rekap_istana[$tanggal] as $satuan => $total)
                                                                @php
                                                                    $qty = $total['total_kuantitas'];
                                                                    $omset = $total['total_omset'];
                                                                @endphp

                                                                @if (fmod($qty, 1) == 0)
                                                                    <div>
                                                                        <br> <strong>Sayur Pack Istana Buah</strong> <br>
                                                                        {{ number_format($qty, 0, ',', '.') }}
                                                                        {{ $satuan }}
                                                                        : Rp{{ number_format($omset, 0, ',', '.') }}
                                                                    </div>
                                                                @else
                                                                    <div>
                                                                        <br> <strong>Sayur Pack Istana Buah</strong> <br>
                                                                        {{ number_format($qty, 2, ',', '.') }}
                                                                        {{ $satuan }}
                                                                        : Rp{{ number_format($omset, 0, ',', '.') }}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if (isset($rekap_lainnya[$tanggal]))
                                                            <div><br><strong>Lainnya</strong></div>
                                                            @php
                                                                $total_lainnya = 0;
                                                            @endphp
                                                            @foreach ($rekap_lainnya[$tanggal] as $item)
                                                                @php
                                                                    $produk = $item->produk;
                                                                    $qty = $item->total_kuantitas;
                                                                    $omset = $item->omset;
                                                                    $satuan = $item->satuan;
                                                                    $total_lainnya += $omset;
                                                                @endphp

                                                                <div>
                                                                    <strong>{{ $produk }}</strong> <br>

                                                                    @if (fmod($qty, 1) == 0)
                                                                        {{ number_format($qty, 0, ',', '.') }}
                                                                    @else
                                                                        {{ number_format($qty, 2, ',', '.') }}
                                                                    @endif

                                                                    {{ $satuan }} :
                                                                    Rp{{ number_format($omset, 0, ',', '.') }}
                                                                </div>
                                                            @endforeach
                                                            @if (count($rekap_lainnya[$tanggal]) > 1)
                                                                <div>
                                                                    <strong>Total Lainnya : Rp {{ number_format($total_lainnya, 0, ',', '.') }}</strong>
                                                                </div>
                                                            @endif
                                                        @endif
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
                                    {{-- <tr class="fw-bold bg-light">
                                        <td colspan="4">Total</td>
                                        <td>
                                            @if (isset($rekap_selada_akhir))
                                                @foreach ($rekap_selada_akhir as $satuan => $total)
                                                    <div><strong>Selada Kg-an</strong><br></div>
                                                    @php
                                                        $qty = $total['total_kuantitas'];
                                                        $omset = $total['total_omset'];
                                                    @endphp

                                                    @if (fmod($qty, 1) == 0)
                                                        <div>
                                                            {{ number_format($qty, 0, ',', '.') }} {{ $satuan }} :
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </div>
                                                    @else
                                                        <div>
                                                            {{ number_format($qty, 2, ',', '.') }} {{ $satuan }} :
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (isset($rekap_aeon_akhir))
                                                @foreach ($rekap_aeon_akhir as $satuan => $total)
                                                    <div><br><strong>Sayur Pack Aeon</strong></div>
                                                    @php
                                                        $qty = $total['total_kuantitas'];
                                                        $omset = $total['total_omset'];
                                                    @endphp

                                                    @if (fmod($qty, 1) == 0)
                                                        <div>
                                                            {{ number_format($qty, 0, ',', '.') }} {{ $satuan }} :
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </div>
                                                    @else
                                                        <div>
                                                            {{ number_format($qty, 2, ',', '.') }} {{ $satuan }} :
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (isset($rekap_istana_akhir))
                                                @foreach ($rekap_istana_akhir as $satuan => $total)
                                                    <div><br><strong>Sayur Pack Istana Buah</strong></div>
                                                    @php
                                                        $qty = $total['total_kuantitas'];
                                                        $omset = $total['total_omset'];
                                                    @endphp

                                                    @if (fmod($qty, 1) == 0)
                                                        <div>
                                                            {{ number_format($qty, 0, ',', '.') }} {{ $satuan }} :
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </div>
                                                    @else
                                                        <div>
                                                            {{ number_format($qty, 2, ',', '.') }} {{ $satuan }} :
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if (isset($rekap_lainnya_akhir))
                                                <div><br><strong>Lainnya</strong></div>
                                                @foreach ($rekap_lainnya_akhir as $produk => $satuanGroup)
                                                    <div><strong>{{ $produk }}</strong><br></div>
                                                    @foreach ($satuanGroup as $satuan => $total)
                                                        @php
                                                            $qty = $total['total_kuantitas'];
                                                            $omset = $total['total_omset'];
                                                        @endphp

                                                        @if (fmod($qty, 1) == 0)
                                                            <div>
                                                                {{ number_format($qty, 0, ',', '.') }} {{ $satuan }}
                                                                : Rp
                                                                {{ number_format($omset, 0, ',', '.') }}
                                                            </div>
                                                            <br>
                                                        @else
                                                            <div>
                                                                {{ number_format($qty, 2, ',', '.') }} {{ $satuan }}
                                                                : Rp
                                                                {{ number_format($omset, 0, ',', '.') }}
                                                            </div>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h2 class="ms-3 mb-2">Total Pemasukan</h2>
                        <div class="table-responsive">
                            <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th>Jenis Pemasukan</th>
                                        <th>Total Kuantitas</th>
                                        <th>Total Omset</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($rekap_selada_akhir))
                                        <tr data-bs-toggle="collapse"
                                            data-bs-target="#selada"
                                            class="cursor-pointer">
                                            <td colspan="2">
                                                <span class="dropdown-toggle"><strong>Selada</strong></span>
                                            </td>
                                            <td>
                                                Rp
                                                {{ number_format($total_pemasukan_selada, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        @foreach ($rekap_selada_akhir as $satuan => $total)
                                            @php
                                                $qty = $total['total_kuantitas'];
                                                $omset = $total['total_omset'];
                                            @endphp

                                            @if (fmod($qty, 1) == 0)
                                                <tr class="collapse bg-light" id="selada">
                                                    <td></td>
                                                    <td>
                                                        {{ number_format($qty, 0, ',', '.') }} {{ $satuan }}
                                                    </td>
                                                    <td>
                                                        Rp {{ number_format($omset, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="collapse bg-light" id="selada">
                                                    <td></td>
                                                    <td>
                                                        {{ number_format($qty, 2, ',', '.') }} {{ $satuan }}
                                                    </td>
                                                    <td>
                                                        Rp {{ number_format($omset, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (isset($rekap_aeon_akhir))
                                        <tr>
                                            @foreach ($rekap_aeon_akhir as $satuan => $total)
                                                <td><strong>Sayur Pack Aeon</strong></td>
                                                @php
                                                    $qty = $total['total_kuantitas'];
                                                    $omset = $total['total_omset'];
                                                @endphp

                                                @if (fmod($qty, 1) == 0)
                                                    <td>
                                                        {{ number_format($qty, 0, ',', '.') }} {{ $satuan }}
                                                    </td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($omset, 0, ',', '.') }}
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ number_format($qty, 2, ',', '.') }} {{ $satuan }}
                                                    </td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($omset, 0, ',', '.') }}
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                    @if (isset($rekap_istana_akhir))
                                        <tr>
                                            @foreach ($rekap_istana_akhir as $satuan => $total)
                                                <td><strong>Sayur Pack Istana Buah</strong></td>
                                                @php
                                                    $qty = $total['total_kuantitas'];
                                                    $omset = $total['total_omset'];
                                                @endphp

                                                @if (fmod($qty, 1) == 0)
                                                    <td>
                                                        {{ number_format($qty, 0, ',', '.') }} {{ $satuan }}
                                                    </td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($omset, 0, ',', '.') }}
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ number_format($qty, 2, ',', '.') }} {{ $satuan }}
                                                    </td>
                                                    <td>
                                                        Rp
                                                        {{ number_format($omset, 0, ',', '.') }}
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                    @if (isset($rekap_lainnya_akhir))
                                        <tr data-bs-toggle="collapse"
                                            data-bs-target="#lainnya"
                                            class="cursor-pointer">
                                            <td colspan="2">
                                                <span class="dropdown-toggle"><strong>Lainnya</strong></span>
                                            </td>
                                            <td>
                                                Rp
                                                {{ number_format($total_pemasukan_lainnya, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        @foreach ($rekap_lainnya_akhir as $produk => $satuanGroup)
                                            @foreach ($satuanGroup as $satuan => $total)
                                                <tr class="collapse bg-light" id="lainnya">
                                                    <td><strong>{{ $produk }}</strong></td>
                                                    @php
                                                        $qty = $total['total_kuantitas'];
                                                        $omset = $total['total_omset'];
                                                    @endphp

                                                    @if (fmod($qty, 1) == 0)

                                                        <td>
                                                            {{ number_format($qty, 0, ',', '.') }} {{ $satuan }}
                                                        </td>
                                                        <td>
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </td>
                                                    @else
                                                        <td>
                                                            {{ number_format($qty, 2, ',', '.') }} {{ $satuan }}
                                                        </td>
                                                        <td>
                                                            Rp
                                                            {{ number_format($omset, 0, ',', '.') }}
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
