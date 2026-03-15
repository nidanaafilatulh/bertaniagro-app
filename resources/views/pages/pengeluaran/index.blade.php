@extends('layouts.pages-layouts')
@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Pengeluaran
                    </h2>
                    <div class="page-pretitle">
                        {{ $tanggal_hari_ini }}
                    </div>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="/pengeluaran/create" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Data
                        </a>
                        <a href="/create/kumulatif/pengeluaran" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Data Kumulatif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <div class="page-body">
        <div class="container-xl">
            @if (session()->has('success'))
                <div class="alert alert-success col-lg-8" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-12">
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-transaksi-pengeluaran" class="nav-link active" data-bs-toggle="tab"
                                        aria-selected="true"
                                        role="tab"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-2">
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                        </svg>Daftar Transaksi Pengeluaran</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-items" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                        tabindex="-1"
                                        role="tab"><!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-album">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -12" />
                                            <path d="M12 4v7l2 -2l2 2v-7" />
                                        </svg>Daftar Jenis & Item Pengeluaran</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-transaksi-pengeluaran" role="tabpanel">
                                    <form method="GET" action="/pengeluaran"
                                        class="d-flex flex-wrap align-items-end gap-3">

                                        <div class="text-secondary">
                                            <label class="form-label fw-semibold mb-1">Show</label>
                                            <input type="number" name="show"
                                                class="form-control form-control-sm d-inline w-auto"
                                                value="{{ request('show', 10) }}">
                                            entries
                                        </div>
                                        <div class="ms-auto">
                                            <div class="d-flex flex-wrap align-items-end gap-3">

                                                <div>
                                                    <label class="form-label fw-semibold mb-1">Tanggal Mulai</label>
                                                    <input type="date" name="tanggal_mulai" class="form-control"
                                                        value="{{ request('tanggal_mulai') }}">
                                                </div>

                                                <div>
                                                    <label class="form-label fw-semibold mb-1">Tanggal Akhir</label>
                                                    <input type="date" name="tanggal_akhir" class="form-control"
                                                        value="{{ request('tanggal_akhir') }}">
                                                </div>

                                                <div>
                                                    <label class="form-label fw-semibold mb-1">Search</label>
                                                    <input type="text" name="search" class="form-control"
                                                        placeholder="Cari..." value="{{ request('search') }}">
                                                </div>

                                                <div>
                                                    <button class="btn btn-primary" type="submit">Filter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive mt-3">
                                        <table
                                            class="table table-selectable card-table table-vcenter text-nowrap datatable">
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
                                                    <th>Jenis Pengeluaran</th>
                                                    <th>Nama Item</th>
                                                    <th>Keterangan</th>
                                                    <th>Kuantitas</th>
                                                    <th>Harga per-Item</th>
                                                    <th>Jumlah</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($daftar_pengeluaran as $pengeluaran)
                                                    <tr>
                                                        <td><span
                                                                class="text-secondary">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}</span>
                                                        </td>
                                                        <td>
                                                            {{ $pengeluaran->itemPengeluaran->jenisPengeluaran->nama }}
                                                        </td>
                                                        <td>
                                                            {{ $pengeluaran->itemPengeluaran->nama }}
                                                        </td>
                                                        <td>
                                                            {{ $pengeluaran->keterangan }}
                                                        </td>
                                                        <td>
                                                            @if (fmod($pengeluaran->kuantitas, 1) == 0)
                                                                {{ number_format($pengeluaran->kuantitas, 0, ',', '.') }}
                                                            @else
                                                                {{ number_format($pengeluaran->kuantitas, 2, ',', '.') }}
                                                            @endif
                                                        </td>
                                                        <td>Rp
                                                            {{ number_format($pengeluaran->harga_per_item, 0, ',', '.') }}
                                                        </td>
                                                        <td>Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                                        <td class="text-end">
                                                            <div class="btn-list flex-nowrap justify-content-end">
                                                                <a href="#" class="btn btn-outline-warning"
                                                                    data-bs-toggle="modal" data-bs-target="#modal-edit"
                                                                    data-id="{{ $pengeluaran->id }}"
                                                                    data-tanggal="{{ $pengeluaran->tanggal }}"
                                                                    data-jenis="{{ $pengeluaran->itemPengeluaran->jenisPengeluaran->id }}"
                                                                    data-item="{{ $pengeluaran->itemPengeluaran->id }}"
                                                                    data-ket="{{ $pengeluaran->keterangan }}"
                                                                    data-kuantitas="{{ $pengeluaran->kuantitas }}"
                                                                    data-harga="{{ $pengeluaran->harga_per_item }}">
                                                                    Edit
                                                                </a>
                                                                <a href="#" class="btn btn-outline-danger"
                                                                    data-bs-toggle="modal" data-bs-target="#modal-delete"
                                                                    data-id="{{ $pengeluaran->id }}">
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row g-2 justify-content-center justify-content-sm-between">
                                            <div class="col-auto d-flex align-items-center">
                                                <p class="m-0 text-secondary">
                                                    Showing <strong>{{ $daftar_pengeluaran->firstItem() }}</strong>
                                                    to <strong>{{ $daftar_pengeluaran->lastItem() }}</strong>
                                                    of <strong>{{ $daftar_pengeluaran->total() }}</strong> entries
                                                </p>
                                            </div>
                                            <div class="col-auto">
                                                {{ $daftar_pengeluaran->links('vendor.pagination.tabler') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-items" role="tabpanel">
                                    <div class="mb-3">
                                        <a href="/jenis-pengeluaran/create"
                                            class="btn btn-success btn-5 d-none d-sm-inline-block">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-2">
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            Tambah Jenis Pengeluaran
                                        </a>
                                        <a href="/item-pengeluaran/create"
                                            class="btn btn-warning btn-5 d-none d-sm-inline-block">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-2">
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            Tambah Item Pengeluaran
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter table-mobile-md card-table">
                                            <thead>
                                                <tr>
                                                    <th>Jenis Pengeluaran</th>
                                                    <th>Item Pengeluaran</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($daftar_jenis_pengeluaran as $jenis)
                                                    @if ($jenis->itemPengeluaran->isNotEmpty())
                                                        @foreach ($jenis->itemPengeluaran as $index => $item)
                                                            <tr>
                                                                @if ($index == 0)
                                                                    <td rowspan="{{ $jenis->itemPengeluaran->count() }}">
                                                                        {{ $jenis->nama }}
                                                                        {{-- <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#modal-edit-jenis"
                                                                            data-id-jenis="{{ $jenis->id }}"
                                                                            data-nama-jenis="{{ $jenis->nama }}">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                                <path
                                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                                                <path d="M16 5l3 3" />
                                                                            </svg>
                                                                        </a> --}}
                                                                        @if ($jenis->itemPengeluaran->count() > 0)
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path d="M4 7l16 0" />
                                                                                <path d="M10 11l0 6" />
                                                                                <path d="M14 11l0 6" />
                                                                                <path
                                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                <path
                                                                                    d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                            </svg>
                                                                        @else
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#modal-delete-jenis"
                                                                                data-id-jenis="{{ $jenis->id }}"
                                                                                style="color: red;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none" />
                                                                                    <path d="M4 7l16 0" />
                                                                                    <path d="M10 11l0 6" />
                                                                                    <path d="M14 11l0 6" />
                                                                                    <path
                                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                    <path
                                                                                        d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                                </svg>
                                                                            </a>
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    {{ $item->nama }}
                                                                    @if ($item->transaksi_pengeluaran_count > 0)
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path d="M4 7l16 0" />
                                                                                <path d="M10 11l0 6" />
                                                                                <path d="M14 11l0 6" />
                                                                                <path
                                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                <path
                                                                                    d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                            </svg>
                                                                    @else
                                                                        <a href="#" data-bs-toggle="modal"
                                                                            data-bs-target="#modal-delete-item"
                                                                            data-id-item="{{ $item->id }}"
                                                                            style="color: red;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path d="M4 7l16 0" />
                                                                                <path d="M10 11l0 6" />
                                                                                <path d="M14 11l0 6" />
                                                                                <path
                                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                <path
                                                                                    d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                            </svg>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>
                                                                {{ $jenis->nama }}
                                                                <a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-jenis"
                                                                    data-id-jenis="{{ $jenis->id }}"
                                                                    style="color: red;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M4 7l16 0" />
                                                                        <path d="M10 11l0 6" />
                                                                        <path d="M14 11l0 6" />
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                            <td class="text-muted">Belum ada item</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Hapus Data Pengeluaran</div>
                    <div>Apakah kamu yakin akan menghapus data pengeluaran ini?</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Tanggal Pengeluaran*</label>
                                <input type="date" class="form-control" name="tanggal" id="edit_tanggal" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Jenis Pengeluaran*</label>
                                <select class="form-select" name="jenis_pengeluaran" id="edit_jenis_pengeluaran"
                                    required>
                                    <option value="">Pilih Jenis Pengeluaran</option>
                                    @foreach ($daftar_jenis_pengeluaran as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Nama Item*</label>
                                <select class="form-select" name="id_item" id="edit_nama_item" required>
                                    <option value="">Pilih Nama Item</option>
                                </select>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="edit_keterangan">
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Kuantitas*</label>
                                <input type="number" step="0.01" class="form-control" name="kuantitas"
                                    id="edit_kuantitas" required>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Harga per-Item*</label>
                                <input type="text" class="form-control" id="edit_harga_per_item_display" required>
                                <input type="hidden" name="harga_per_item" id="edit_harga_per_item">
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="text" class="form-control" id="edit_jumlah_display" readonly>
                                <input type="hidden" name="jumlah" id="edit_jumlah">
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal modal-blur fade" id="modal-edit-jenis" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="editJenisForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jenis Pengeluaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Jenis Pengeluaran*</label>
                            <input type="text" name="nama_jenis_pengeluaran" id="edit_jenis_pengeluaran"
                                class="form-control" placeholder="Masukkan nama jenis pengeluaran" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="modal modal-blur fade" id="modal-delete-jenis" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Hapus Data Jenis Pengeluaran</div>
                    <div>
                        Apakah kamu yakin akan menghapus jenis pengeluaran ini?
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="deleteJenisForm" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-delete-item" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Hapus Data Item Pengeluaran</div>
                    <div>
                        Apakah kamu yakin akan menghapus item pengeluaran ini?
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="deleteItemForm" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteModal = document.getElementById('modal-delete');
            const deleteProdukModal = document.getElementById('modal-delete-produk');
            const deleteItemModal = document.getElementById('modal-delete-item');
            const deleteJenisModal = document.getElementById('modal-delete-jenis');

            deleteModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-id');

                // set action form
                let form = document.getElementById('deleteForm');
                form.action = "/pengeluaran/" + id;
            });

            deleteItemModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-id-item');

                // set action form
                let form = document.getElementById('deleteItemForm');
                form.action = "/item-pengeluaran/" + id;
            });

            deleteJenisModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-id-jenis');

                // set action form
                let form = document.getElementById('deleteJenisForm');
                form.action = "/jenis-pengeluaran/" + id;
            });
        });
    </script>
    <script>
        const dataJenis = @json($daftar_jenis_pengeluaran);

        document.addEventListener("DOMContentLoaded", function() {

            const jenisSelect = document.getElementById("edit_jenis_pengeluaran");
            const itemSelect = document.getElementById("edit_nama_item");

            jenisSelect.addEventListener("change", function() {

                let selectedJenis = this.value;

                itemSelect.innerHTML = '<option value="">Pilih Nama Item</option>';

                if (!selectedJenis) return;

                let jenis = dataJenis.find(j => j.id == selectedJenis);

                if (jenis && jenis.item_pengeluaran) {

                    jenis.item_pengeluaran.forEach(item => {

                        let option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = item.nama;

                        itemSelect.appendChild(option);

                    });

                }

            });

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editModal = document.getElementById('modal-edit');

            function formatRupiah(angka) {
                return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function unformatRupiah(rp) {
                return rp.replace(/[^\d]/g, '');
            }

            editModal.addEventListener('show.bs.modal', function(event) {

                let button = event.relatedTarget;
                let id = button.getAttribute('data-id');

                let jenis = button.getAttribute('data-jenis');
                let item = button.getAttribute('data-item');

                document.getElementById('editForm').action = "/pengeluaran/" + id;

                document.getElementById('edit_tanggal').value = button.getAttribute('data-tanggal');
                document.getElementById('edit_keterangan').value = button.getAttribute('data-ket');
                document.getElementById('edit_kuantitas').value = button.getAttribute('data-kuantitas');

                let harga = button.getAttribute('data-harga');

                document.getElementById('edit_harga_per_item').value = harga;
                document.getElementById('edit_harga_per_item_display').value = formatRupiah(harga);

                // SET JENIS
                let jenisSelect = document.getElementById('edit_jenis_pengeluaran');
                jenisSelect.value = jenis;

                // TRIGGER CHANGE AGAR ITEM TERISI
                jenisSelect.dispatchEvent(new Event('change'));

                // SET ITEM SETELAH OPTION TERISI
                setTimeout(() => {
                    document.getElementById('edit_nama_item').value = item;
                }, 100);

                calculateEditJumlah();
            });


            function calculateEditJumlah() {
                let q = parseFloat(document.getElementById('edit_kuantitas').value) || 0;
                let h = parseFloat(document.getElementById('edit_harga_per_item').value) || 0;
                let total = q * h;

                document.getElementById('edit_jumlah').value = total;
                document.getElementById('edit_jumlah_display').value = formatRupiah(total);
            }

            // Harga per item input
            document.getElementById('edit_harga_per_item_display').addEventListener('input', function() {
                let value = unformatRupiah(this.value);
                this.value = formatRupiah(value);
                document.getElementById('edit_harga_per_item').value = value;
                calculateEditJumlah();
            });

            document.getElementById('edit_kuantitas').addEventListener('input', calculateEditJumlah);
        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {

            const editJenisModal = document.getElementById('modal-edit-jenis');

            editJenisModal.addEventListener('show.bs.modal', function(event) {

                const button = event.relatedTarget;

                if (!button) return;

                const id = button.getAttribute('data-id-jenis');
                const nama = button.getAttribute('data-nama-jenis');

                const form = document.getElementById('editJenisForm');
                const inputNama = document.getElementById('edit_jenis_pengeluaran');

                form.action = "/jenis-pengeluaran/" + id;
                inputNama.value = nama;
            });

        });
    </script> --}}
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Aktifkan tab berdasarkan hash URL
        let hash = window.location.hash;
        if (hash) {
            let trigger = document.querySelector(`a[href="${hash}"]`);
            if (trigger) {
                let tab = new bootstrap.Tab(trigger);
                tab.show();
            }
        }

        // Simpan tab yang diklik ke URL hash
        let tabLinks = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabLinks.forEach(function(tab) {
            tab.addEventListener('shown.bs.tab', function(e) {
                history.replaceState(null, null, e.target.getAttribute("href"));
            });
        });

    });
</script>
