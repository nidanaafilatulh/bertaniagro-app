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
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-transaksi-pemasukan" class="nav-link active" data-bs-toggle="tab"
                                    aria-selected="true"
                                    role="tab"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-2">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>Daftar Transaksi Pemasukan</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-produk" class="nav-link" data-bs-toggle="tab" aria-selected="false"
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
                                    </svg>Daftar Produk</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-transaksi-pemasukan" role="tabpanel">
                                <div class="mb-1">
                                    <form method="GET" action="/pemasukan" class="d-flex flex-wrap align-items-end gap-3">
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
                                </div>
                                <div>
                                    <div class="table-responsive mt-5">
                                        <table
                                            class="table table-selectable card-table table-vcenter text-nowrap datatable">
                                            <thead>
                                                <tr>
                                                    <th class="w-1">Tanggal</th>
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
                                                                {{ $pemasukan->itemPemasukan[0]->produk->nama_produk }}
                                                                (@if ($pemasukan->itemPemasukan[0]->kuantitas % 1 == 0)
                                                                    {{ number_format($pemasukan->itemPemasukan[0]->kuantitas, 0, ',', '.') }} {{ $pemasukan->itemPemasukan[0]->produk->satuan }}
                                                                @else
                                                                    {{ number_format($pemasukan->itemPemasukan[0]->kuantitas, 2, ',', '.') }} {{ $pemasukan->itemPemasukan[0]->produk->satuan }}
                                                                @endif)
                                                                <br>
                                                            @elseif ($pemasukan->itemPemasukan->count() > 1)
                                                                @foreach ($pemasukan->itemPemasukan as $item)
                                                                    - {{ $item->produk->nama_produk }} (@if($item->kuantitas % 1 == 0)
                                                                        {{ number_format($item->kuantitas, 0, ',', '.') }} {{ $item->produk->satuan }}
                                                                    @else
                                                                        {{ number_format($item->kuantitas, 2, ',', '.') }} {{ $item->produk->satuan }}
                                                                    @endif)<br>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="btn-list flex-nowrap justify-content-end">
                                                                @if ($pemasukan->bukti_bayar == null)
                                                                    <a href="#" class="btn btn-outline-warning"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-upload"
                                                                        data-no_transaksi="{{ $pemasukan->no_transaksi }}">
                                                                        Unggah Bukti Bayar
                                                                    </a>
                                                                @endif

                                                                <a href="/pemasukan/{{ $pemasukan->no_transaksi }}"
                                                                    class="btn btn-outline-info">
                                                                    Detail Transaksi
                                                                </a>

                                                                <a href="#" class="btn btn-outline-danger"
                                                                    data-bs-toggle="modal" data-bs-target="#modal-delete"
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
                                </div>
                                <div class="card-footer px-0 border-0 mt-3">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <p class="m-0 text-secondary">
                                            Showing
                                            <strong>{{ $daftar_pemasukan->firstItem() ?? 0 }}</strong>
                                            to
                                            <strong>{{ $daftar_pemasukan->lastItem() ?? 0 }}</strong>
                                            of
                                            <strong>{{ $daftar_pemasukan->total() }}</strong> entries
                                        </p>
                                        {{ $daftar_pemasukan->appends(request()->query())->links('vendor.pagination.tabler') }}

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-produk" role="tabpanel">
                                <div>
                                    <div class="mb-3">
                                        <a href="/produk/create" class="btn btn-success btn-5 d-none d-sm-inline-block">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-2">
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            Tambah Produk
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter table-mobile-md card-table">
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Satuan</th>
                                                    <th>Harga Normal</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($daftar_produk as $produk)
                                                    <tr>
                                                        <td data-label="nama_produk">
                                                            <div class="d-flex py-1 align-items-center">
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">
                                                                        {{ $produk->nama_produk }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-label="satuan">
                                                            <div>{{ $produk->satuan }}</div>
                                                        </td>
                                                        <td class="text-secondary" data-label="harga_satuan_normal">Rp
                                                            {{ number_format($produk->harga_satuan_normal, 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-end">
                                                            <div class="btn-list flex-nowrap justify-content-end">
                                                                @if($produk->itemPemasukan->count() > 0)
                                                                    <a href="#" class="btn btn-outline-warning disabled">
                                                                        Tidak Bisa Edit/Hapus
                                                                    </a>
                                                                @else
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#modal-edit"
                                                                        data-id-produk="{{ $produk->id }}"
                                                                        data-nama="{{ $produk->nama_produk }}"
                                                                        data-satuan="{{ $produk->satuan }}"
                                                                        data-harga="{{ $produk->harga_satuan_normal }}"
                                                                        class="btn btn-outline-warning">
                                                                        Edit
                                                                    </a>

                                                                    <a href="#" class="btn btn-outline-danger"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modal-delete-produk"
                                                                        data-id-produk="{{ $produk->id }}">
                                                                        Hapus
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let activeTab = localStorage.getItem("activeTab");

            if (activeTab) {
                let trigger = document.querySelector(`a[href="${activeTab}"]`);
                if (trigger) {
                    new bootstrap.Tab(trigger).show();
                }
            }

            document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function(tab) {
                tab.addEventListener("shown.bs.tab", function(e) {
                    localStorage.setItem("activeTab", e.target.getAttribute("href"));
                });
            });

        });
    </script>
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
                        <h5 class="modal-title">Upload Bukti Bayar (JPG, JPEG, PNG, max 2 MB)</h5>
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
        document.getElementById('bukti_bayar').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2 MB
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
                errorDiv.textContent = "Ukuran file maksimal 2 MB.";

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
    <div class="modal modal-blur fade" id="modal-delete-produk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Hapus Data Produk</div>
                    <div>
                        Apakah kamu yakin akan menghapus produk ini?
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">Batal</button>
                    <form id="deleteProdukForm" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Produk*</label>
                            <input type="text" name="nama_produk" id="edit_produk" class="form-control"
                                placeholder="Masukkan nama produk" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Satuan*</label>
                            <input type="text" name="satuan" id="edit_satuan" class="form-control"
                                placeholder="Masukkan satuan" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga Satuan Normal*</label>
                            <input type="number" name="harga_satuan_normal" id="edit_harga_satuan_normal"
                                class="form-control harga-format" placeholder="Masukkan harga satuan normal" required>
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

            const modalEdit = document.getElementById('modal-edit');

            modalEdit.addEventListener('show.bs.modal', function(event) {

                // tombol yang diklik
                const button = event.relatedTarget;

                // ambil data dari atribut
                const id = button.getAttribute('data-id-produk');
                const nama = button.getAttribute('data-nama');
                const satuan = button.getAttribute('data-satuan');
                const harga = button.getAttribute('data-harga');

                // isi input modal
                document.getElementById('edit_produk').value = nama;
                document.getElementById('edit_satuan').value = satuan;
                document.getElementById('edit_harga_satuan_normal').value = harga;

                // set action form
                const form = document.getElementById('editForm');
                form.action = '/produk/' + id;

            });

        });
    </script>
    <script>
        const deleteModal = document.getElementById('modal-delete');
        const uploadModal = document.getElementById('modal-upload');
        const deleteProdukModal = document.getElementById('modal-delete-produk');

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

        deleteProdukModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let idProduk = button.getAttribute('data-id-produk');

            let form = document.getElementById('deleteProdukForm');
            form.action = "/produk/" + idProduk;
        });
    </script>
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
