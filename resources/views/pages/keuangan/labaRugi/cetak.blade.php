<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Laba Rugi</title>
</head>

<body>
    <h1>Laporan Laba Rugi</h1>
    <p>Periode: {{ $tanggal_mulai }} hingga {{ $tanggal_akhir }}</p>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th colspan="2" style="background:#f0f0f0; font-weight:bold;">Pemasukan</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($pemasukan as $item)
                <tr>
                    <td>{{ $item->produk }}</td>
                    <td>{{ number_format($item->omset, 2, ',', '.') }}</td>
                </tr>
            @endforeach --}}
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
            <tr>
                <td style="font-weight:bold;">Total Pemasukan</td>
                <td style="font-weight:bold;">Rp {{ number_format($total_omset_pemasukan, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th colspan="2" style="background:#f0f0f0; font-weight:bold;">Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $item)
                <tr>
                    <td>{{ $item->jenis_pengeluaran }}</td>
                    <td>{{ number_format($item->total_pengeluaran, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tr>
            <td style="font-weight:bold;">Total Pengeluaran</td>
            <td style="font-weight:bold;">Rp {{ number_format($pengeluaran_total, 2, ',', '.') }}</td>
        </tr>
    </table>
    <br>
    @if ($total < 0)
        <div><h2>Rugi : Rp {{ number_format($total, 0, ',', '.') }}</h2></div>
    @elseif($total > 0)
        <div><h2>Laba : Rp {{ number_format($total, 0, ',', '.') }}</h2></div>
    @else
        <div><h2>Total : Rp {{ number_format($total, 0, ',', '.') }}</h2></div>
    @endif
</body>

</html>
