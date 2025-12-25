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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Transaksi Pengeluaran</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <form method="GET" action="/pengeluaran" class="d-flex flex-wrap align-items-end gap-3">

                            <div class="text-secondary">
                                <label class="form-label fw-semibold mb-1">Show</label>
                                <input type="number" name="show" class="form-control form-control-sm d-inline w-auto"
                                    value="{{ request('show', 10) }}">
                                entries
                            </div>
                            <div class="ms-auto">
                                <div class="d-flex flex-wrap align-items-end gap-3">

                                        <div>
                                            <label class="form-label fw-semibold mb-1">Tanggal Mulai</label>
                                            <input type="date" name="tanggal_mulai" class="form-control"
                                                value="{{ request('tanggal_mulai', $tanggal_mulai) }}" >
                                        </div>

                                        <div>
                                            <label class="form-label fw-semibold mb-1">Tanggal Akhir</label>
                                            <input type="date" name="tanggal_akhir" class="form-control"
                                                value="{{ request('tanggal_akhir', $tanggal_akhir) }}" >
                                        </div>

                                        <div>
                                            <label class="form-label fw-semibold mb-1">Search</label>
                                            <input type="text" name="search" class="form-control" placeholder="Cari..."
                                                value="{{ request('search') }}">
                                        </div>

                                        <div>
                                            <button class="btn btn-primary" type="submit">Filter</button>
                                        </div>

                                    </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-selectable card-table table-vcenter text-nowrap datatable">
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
                                            {{ $pengeluaran->jenis_pengeluaran }}
                                        </td>
                                        <td>
                                            {{ $pengeluaran->nama_item }}
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
                                        <td>Rp {{ number_format($pengeluaran->harga_per_item, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($pengeluaran->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-end">
                                            <div class="btn-list flex-nowrap justify-content-end">
                                                <a href="#" class="btn btn-1" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit" data-id="{{ $pengeluaran->id }}"
                                                    data-tanggal="{{ $pengeluaran->tanggal }}"
                                                    data-jenis="{{ $pengeluaran->jenis_pengeluaran }}"
                                                    data-nama="{{ $pengeluaran->nama_item }}"
                                                    data-ket="{{ $pengeluaran->keterangan }}"
                                                    data-kuantitas="{{ $pengeluaran->kuantitas }}"
                                                    data-harga="{{ $pengeluaran->harga_per_item }}">
                                                    Edit
                                                </a>
                                                <a href="#" class="btn btn-1" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete" data-id="{{ $pengeluaran->id }}">
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
                                <label class="form-label">Tanggal Pengeluaran</label>
                                <input type="date" class="form-control" name="tanggal" id="edit_tanggal" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Jenis Pengeluaran</label>
                                <input type="text" class="form-control" name="jenis_pengeluaran"
                                    id="edit_jenis_pengeluaran" required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Nama Item</label>
                                <input type="text" class="form-control" name="nama_item" id="edit_nama_item"
                                    required>
                            </div>

                            <div class="col-lg-6 mb-3">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="edit_keterangan">
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Kuantitas</label>
                                <input type="number" step="0.01" class="form-control" name="kuantitas"
                                    id="edit_kuantitas" required>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Harga per-Item</label>
                                <input type="number" class="form-control" name="harga_per_item"
                                    id="edit_harga_per_item" required>
                            </div>

                            <div class="col-lg-4 mb-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="edit_jumlah" readonly>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteModal = document.getElementById('modal-delete');

            deleteModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-id');

                // set action form
                let form = document.getElementById('deleteForm');
                form.action = "/pengeluaran/" + id;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editModal = document.getElementById('modal-edit');

            editModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;

                let id = button.getAttribute('data-id');

                // Set form action (PUT)
                document.getElementById('editForm').action = "/pengeluaran/" + id;

                // Set input values
                document.getElementById('edit_tanggal').value = button.getAttribute('data-tanggal');
                document.getElementById('edit_jenis_pengeluaran').value = button.getAttribute('data-jenis');
                document.getElementById('edit_nama_item').value = button.getAttribute('data-nama');
                document.getElementById('edit_keterangan').value = button.getAttribute('data-ket');
                document.getElementById('edit_kuantitas').value = button.getAttribute('data-kuantitas');
                document.getElementById('edit_harga_per_item').value = button.getAttribute('data-harga');

                // Calculate jumlah
                calculateEditJumlah();
            });

            function calculateEditJumlah() {
                let q = parseFloat(document.getElementById('edit_kuantitas').value) || 0;
                let h = parseFloat(document.getElementById('edit_harga_per_item').value) || 0;
                document.getElementById('edit_jumlah').value = q * h;
            }

            document.getElementById('edit_kuantitas').addEventListener('input', calculateEditJumlah);
            document.getElementById('edit_harga_per_item').addEventListener('input', calculateEditJumlah);
        });
    </script>
@endsection
