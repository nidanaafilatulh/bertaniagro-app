<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Pemasukan</title>
</head>

<body>
    <h1>Rekap Pemasukan</h1>
    <p>Periode: {{ $tanggal_mulai }} hingga {{ $tanggal_akhir }}</p>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Tanggal</th>
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
                            <td rowspan="{{ $rowspan }}">{{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</td>
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
                                        <div><strong>Total Selada : Rp
                                            {{ number_format($total_selada, 0, ',', '.') }}</strong></div>
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
                                        <div><strong>Total Lainnya : Rp
                                            {{ number_format($total_lainnya, 0, ',', '.') }}</strong>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        @endif

                        @if ($index == 0)
                            <td rowspan="{{ $rowspan }}">
                                Rp {{ number_format($total_omset_harian[$tanggal], 0, ',', '.') }}
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <h2 class="ms-3 mb-2">Total Pemasukan</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Jenis Pemasukan</th>
                <th>Total Kuantitas</th>
                <th>Total Omset</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($rekap_selada_akhir))
                <tr data-bs-toggle="collapse" data-bs-target="#selada" class="cursor-pointer">
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
                <tr data-bs-toggle="collapse" data-bs-target="#lainnya" class="cursor-pointer">
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
    {{-- <p><strong>Rekap</strong></p>
    @foreach ($total_kuantitas_per_satuan as $satuan => $total)
        @php
            $qty = $total['total_kuantitas'];
            $omset = $total['total_omset'];
        @endphp

        @if (fmod($qty, 1) == 0)
            <div>
                {{ number_format($qty, 0, ',', '.') }}
                {{ $satuan }} : Rp{{ number_format($omset, 0, ',', '.') }}
            </div>
        @else
            <div>
                {{ number_format($qty, 2, ',', '.') }}
                {{ $satuan }} : Rp{{ number_format($omset, 0, ',', '.') }}
            </div>
        @endif
    @endforeach
    <p><strong>Total Pemasukan: Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</strong></p> --}}
</body>

</html>
