@extends('layouts.pages-layouts')
@section('container')
    <!-- BEGIN PAGE HEADER -->
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
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="/pemasukan/create" class="btn btn-primary btn-5 d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah Data
                        </a>
                        <a href="/create/kumulatif/pemasukan" class="btn btn-primary btn-5 d-none d-sm-inline-block">
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
                        <h3 class="card-title">Daftar Transaksi Pemasukan</h3>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <form method="GET" action="/pemasukan" class="d-flex flex-wrap align-items-end gap-3">

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
                                            value="{{ request('tanggal_mulai', $tanggal_mulai) }}">
                                    </div>

                                    <div>
                                        <label class="form-label fw-semibold mb-1">Tanggal Akhir</label>
                                        <input type="date" name="tanggal_akhir" class="form-control"
                                            value="{{ request('tanggal_akhir', $tanggal_akhir) }}">
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
                                    <th>Pelanggan</th>
                                    <th>No Transaksi</th>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                    <th>Produk</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftar_pemasukan as $pemasukan)
                                    <tr>
                                        <td><span
                                                class="text-secondary">{{ \Carbon\Carbon::parse($pemasukan->tanggal_transaksi)->format('d M Y') }}</span>
                                        </td>
                                        <td>
                                            {{ $pemasukan->pelanggan }}
                                        </td>
                                        <td>
                                            {{ $pemasukan->no_transaksi }}
                                        </td>
                                        <td>
                                            @if ($pemasukan->bukti_bayar != null)
                                                <span class="badge bg-success me-1"></span>
                                                Lunas
                                            @else
                                                <span class="badge bg-danger me-1"></span>
                                                Hutang
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($pemasukan->jumlah, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($pemasukan->itemPemasukan->count() == 1)
                                                {{ $pemasukan->itemPemasukan[0]->produk }}
                                                ({{ $pemasukan->itemPemasukan[0]->satuan }})
                                                <br>
                                            @elseif ($pemasukan->itemPemasukan->count() > 1)
                                                @foreach ($pemasukan->itemPemasukan as $item)
                                                    - {{ $item->produk }} ({{ $item->satuan }})<br>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-list flex-nowrap justify-content-end">
                                                @if ($pemasukan->bukti_bayar == null)
                                                    <a href="#" class="btn btn-1" data-bs-toggle="modal"
                                                        data-bs-target="#modal-upload"
                                                        data-no_transaksi="{{ $pemasukan->no_transaksi }}">
                                                        Unggah Bukti Bayar
                                                    </a>
                                                @endif
                                                <a href="/pemasukan/{{ $pemasukan->no_transaksi }}" class="btn btn-1">
                                                    Detail Transaksi
                                                </a>
                                                <a href="#" class="btn btn-1" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete"
                                                    data-no_transaksi="{{ $pemasukan->no_transaksi }}">
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
                                    Showing <strong>{{ $daftar_pemasukan->firstItem() }}</strong>
                                    to <strong>{{ $daftar_pemasukan->lastItem() }}</strong>
                                    of <strong>{{ $daftar_pemasukan->total() }}</strong> entries
                                </p>
                            </div>
                            <div class="col-auto">
                                {{ $daftar_pemasukan->links('vendor.pagination.tabler') }}
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
                    <div class="modal-title">Hapus Transaksi Pemasukan</div>
                    <div>
                        Apakah kamu yakin akan menghapus transaksi Nomor <span id="delete_no_transaksi_text"></span>?
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-upload" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-3 modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="uploadForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="modal-header">
                        <h5 class="modal-title">Upload Bukti Bayar (JPG, JPEG, PNG, max 10 MB)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="no_transaksi" id="upload_no_transaksi">
                            <label class="form-label">Upload File</label>
                            <input type="file" class="form-control" name="bukti_bayar" id="bukti_bayar">

                            <!-- JS error will appear here -->
                            <div id="js-error-bukti"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="uploadSubmit">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('modal-delete');
        const uploadModal = document.getElementById('modal-upload');

        deleteModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let noTransaksi = button.getAttribute('data-no_transaksi');

            // show no_transaksi in text
            document.getElementById('delete_no_transaksi_text').textContent = noTransaksi;

            // set the form action dynamically
            let form = document.getElementById('deleteForm');
            form.action = "/pemasukan/" + noTransaksi;
        });

        uploadModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let noTransaksi = button.getAttribute('data-no_transaksi');

            document.getElementById('upload_no_transaksi').value = noTransaksi;

            let form = document.getElementById('uploadForm');
            form.action = "/pemasukan/" + noTransaksi;
        });
    </script>
    <script>
        document.getElementById('bukti_bayar').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 10 * 1024 * 1024; // 10 MB
            const allowedExtensions = ['jpg', 'jpeg', 'png'];

            const fileExt = file.name.split('.').pop().toLowerCase();


            // Remove old error
            let errorBox = document.getElementById('js-error-bukti');
            if (errorBox) errorBox.remove();

            if (file && file.size > maxSize) {

                // Create error message dynamically
                let errorDiv = document.createElement('div');
                errorDiv.id = 'js-error-bukti';
                errorDiv.classList.add('text-danger', 'mt-2');
                errorDiv.textContent = "Ukuran file maksimal 10 MB.";

                // Insert after input
                this.parentNode.appendChild(errorDiv);

                // Clear the file input
                this.value = "";

                // Prevent modal from closing
                return false;
            } else if (!allowedExtensions.includes(fileExt)) {
                let errorDiv = document.createElement('div');
                errorDiv.id = 'js-error-bukti';
                errorDiv.classList.add('text-danger', 'mt-2');
                errorDiv.textContent = "File harus berupa JPG, JPEG, atau PNG.";

                // Insert after input
                this.parentNode.appendChild(errorDiv);

                // Clear the file input
                this.value = "";

                // Prevent modal from closing
                return false;
            }
        });
    </script>
@endsection
