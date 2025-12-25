<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Cashflow</title>
</head>

<body>
    <h1>Laporan Cashflow</h1>
    <p>Periode: {{ $tanggal_mulai }} hingga {{ $tanggal_akhir }}</p>
    <table border="1" cellpadding="5" cellspacing="0">
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
</body>
</html>
