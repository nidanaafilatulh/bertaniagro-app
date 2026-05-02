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
    @if (request('tanggal_mulai') && request('tanggal_akhir') && request('tanggal_mulai') <= request('tanggal_akhir'))
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>PERKIRAAN</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Pendapatan</strong>
                    </td>
                    <td>
                        Rp {{ number_format($pendapatan, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Harga Pokok Penjualan</strong>
                    </td>
                    <td>
                        Rp {{ number_format($hpp, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Laba Kotor</strong>
                    </td>
                    <td>Rp {{ number_format($labaKotor, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <strong>Beban Operasional:</strong>
                    </td>
                    <td></td>
                </tr>
                @foreach ($beban_pengeluaran as $beban)
                    <tr>
                        <td>
                            <span>Beban {{ Str::title($beban->jenis_beban) }}</span>
                        </td>
                        <td>
                            Rp {{ number_format($beban->beban_pengeluaran, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        <strong>Total Beban Operasional</strong>
                    </td>
                    <td>Rp {{ number_format($total_beban_pengeluaran, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <strong>Laba Bersih Sebelum Pajak</strong>
                    </td>
                    <td>
                        Rp {{ number_format($labaBersihSebelumPajak, 0, ',', '.') }}
                    </td>
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
            <strong>Peringatan! Rentang tanggal yang dimasukan salah.</strong>
        </div>
    @endif
</body>

</html>
