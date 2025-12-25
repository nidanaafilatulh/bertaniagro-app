<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Pengeluaran</title>
</head>

<body>
    <h1>Rekap Pengeluaran</h1>
    <p>Periode: {{ $tanggal_mulai }} hingga {{ $tanggal_akhir }}</p>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th class="fw-bold">Beban</th>
                <th class="fw-bold">Kuantitas</th>
                <th class="fw-bold">Harga</th>
                <th class="fw-bold">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftar_jenis as $jenis)
                <tr data-bs-toggle="collapse" data-bs-target="#{{ Str::slug($jenis->jenis_pengeluaran) }}"
                    class="cursor-pointer">
                    <td colspan="3">
                        <span class="dropdown-toggle"> <strong>{{ $jenis->jenis_pengeluaran }}</strong></span>
                    </td>
                    <td><strong>Rp {{ number_format($jenis->total_pengeluaran, 0, ',', '.') }}</strong></td>
                </tr>
                @foreach ($daftar_item[$jenis->jenis_pengeluaran] ?? [] as $item)
                    <tr class="collapse bg-light" id="{{ Str::slug($jenis->jenis_pengeluaran) }}">
                        <td class="ps-5">{{ $item->nama_item }}</td>
                        <td>
                            @if (fmod($item->total_kuantitas, 1) == 0)
                                {{ number_format($item->total_kuantitas, 0, ',', '.') }}
                            @else
                                {{ number_format($item->total_kuantitas, 2, ',', '.') }}
                            @endif
                        </td>
                        <td>Rp {{ number_format($item->harga_per_item, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->item_pengeluaran, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
            @foreach ($daftar_jenis_lain as $jenis)
                <tr data-bs-toggle="collapse" data-bs-target="#{{ Str::slug($jenis->jenis_pengeluaran) }}"
                    class="cursor-pointer">
                    <td colspan="3">
                        <span class="dropdown-toggle"> <strong>{{ $jenis->jenis_pengeluaran }}</strong></span>
                    </td>
                    <td><strong>Rp {{ number_format($jenis->total_pengeluaran, 0, ',', '.') }}</strong></td>
                </tr>
                @foreach ($daftar_item_lain[$jenis->jenis_pengeluaran] ?? [] as $item)
                    <tr class="collapse bg-light" id="{{ Str::slug($jenis->jenis_pengeluaran) }}">
                        <td class="ps-5">{{ $item->nama_item }}</td>
                        <td></td>
                        <td></td>
                        <td>Rp {{ number_format($item->item_pengeluaran, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
            <tr class="fw-bold bg-light">
                <td colspan="3"><strong>Total Pengeluaran</strong></td>
                <td class="text-end">
                    <div style="text-align: right;">
                        <strong>Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</strong>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
