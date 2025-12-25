<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba Rugi</title>
</head>

<body>
    <h1>Laporan Laba Rugi</h1>
    <p>Periode: {{ $tanggal_mulai }} hingga {{ $tanggal_akhir }}</p>

    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th colspan="2" style="background:#f0f0f0; font-weight:bold;">Pemasukan</th>
            </tr>
        </thead>

        <tbody>
            {{-- @foreach ($pemasukan as $item_pemasukan)
                <tr>
                    <td>
                        {{ $item_pemasukan->produk }} ({{ $item_pemasukan->satuan }})
                    </td>
                    <td>
                        Rp {{ number_format($item_pemasukan->omset, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach --}}
            <tr>
                <td><span class="text-secondary">Penjualan Selada (non-pack)</span></td>
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
            <tr style="font-weight:bold; background:#f9f9f9;">
                <td>Total Pemasukan</td>
                <td>Rp {{ number_format($total_omset_pemasukan, 0, ',', '.') }}</td>
            </tr>
        </tbody>

        <thead>
            <tr>
                <th colspan="2" style="background:#f0f0f0; font-weight:bold;">Pengeluaran</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pengeluaran as $item_pengeluaran)
                <tr>
                    <td>{{ $item_pengeluaran->jenis_pengeluaran }}</td>
                    <td>
                        Rp {{ number_format($item_pengeluaran->total_pengeluaran, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach

            <tr style="font-weight:bold; background:#f9f9f9;">
                <td>Total Pengeluaran</td>
                <td>Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
            </tr>

            <tr style="font-weight:bold; background:#e8e8e8;">
                @if ($total < 0)
                    <td>Rugi</td>
                    <td style="color:red;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                @elseif($total > 0)
                    <td>Laba</td>
                    <td style="color:green;">Rp {{ number_format($total, 0, ',', '.') }}</td>
                @else
                    <td>Total</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                @endif
            </tr>
        </tbody>
    </table>
</body>

</html>
