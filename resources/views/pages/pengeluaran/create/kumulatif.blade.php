@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <a href="{{ url()->previous() }}">Kembali</a>
                    </div>
                    <h2 class="page-title">
                        Tambah Data Transaksi Pengeluaran Kumulatif
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h3 class="card-title">
                            Basic Form
                        </h3>
                    </div> --}}
                    <div class="card-body">
                        <form class="space-y" action="/create/kumulatif/pengeluaran" method="POST">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label class="form-label">Tanggal Transaksi Pengeluaran*</label>
                                    <input type="date" placeholder="Pilih tanggal" class="form-control" name="tanggal"
                                        id="tanggal" value="{{ old('tanggal', $tanggal) }}" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3"><label class="form-label">Jenis Pengeluaran*</label></div>
                                <div class="col-3"><label class="form-label">Nama Item*</label></div>
                                <div class="col-1"><label class="form-label">Kuantitas*</label></div>
                                <div class="col-2"><label class="form-label">Harga per-Item*</label></div>
                                <div class="col-2"><label class="form-label">Jumlah</label></div>
                            </div>
                            <div id="pengeluaran-container">
                                @php
                                    $pengeluaranOld = old('pengeluaran', ['']); // minimal 1 baris
                                @endphp

                                @foreach ($pengeluaranOld as $i => $p)
                                    <div class="row mt-1 pengeluaran-row">
                                        <div class="col-3">
                                            <select name="jenis_pengeluaran[]"
                                                class="form-select jenis-pengeluaran @error('jenis_pengeluaran.*') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Jenis Pengeluaran</option>
                                                @foreach ($daftar_jenis_pengeluaran as $jenis)
                                                    <option value="{{ $jenis->nama }}">
                                                        {{ $jenis->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <select name="nama_item[]"
                                                class="form-select nama-item @error('nama_item.*') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Nama Item</option>
                                            </select>
                                        </div>

                                        <div class="col-1">
                                            <input type="number" step="0.01"
                                                class="form-control qty @error('kuantitas.*') is-invalid @enderror"
                                                id="kuantitas" name="kuantitas[]" value="{{ old('kuantitas.' . $i) }}"
                                                required>
                                            @error('kuantitas.*')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" placeholder="Masukkan harga"
                                                class="form-control harga @error('harga_per_item.*') is-invalid @enderror"
                                                name="harga_per_item[]" oninput="formatRupiah(this)"
                                                value="{{ old('harga_per_item.' . $i) }}" required>
                                            @error('harga_per_item.*')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control jumlah" name="jumlah[]" id="jumlah"
                                                value="{{ old('jumlah.' . $i) }}" readonly>
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center mt-1">
                                            <button type="button" class="btn-remove border-0 bg-transparent p-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-circle-minus">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M9 12l6 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <a href="#" id="btn-tambah-data-pengeluaran"
                                        class="btn btn-primary d-none d-sm-inline-block">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-3">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BODY -->

    <script>
        function formatRupiah(input) {
            let angka = input.value.replace(/[^0-9]/g, "");
            if (angka === "") {
                input.value = "";
                return;
            }
            input.value = "Rp " + new Intl.NumberFormat('id-ID').format(angka);
        }

        document.addEventListener('input', function(e) {
            let row = e.target.closest('.pengeluaran-row');
            if (!row) return;

            // formatting harga
            if (e.target.classList.contains('harga')) {
                formatRupiah(e.target);
            }

            hitungJumlah(row);
        });


        function hitungJumlah(row) {
            let qty = parseFloat(row.querySelector('.qty').value) || 0;

            let hargaText = row.querySelector('.harga').value;
            let harga = parseFloat(hargaText.replace(/[^0-9]/g, "")) || 0;

            let total = qty * harga;

            row.querySelector('.jumlah').value =
                "Rp " + new Intl.NumberFormat('id-ID').format(total);
        }
    </script>
    <script>
        const container = document.getElementById("pengeluaran-container");

        document.getElementById("btn-tambah-data-pengeluaran").addEventListener("click", function(e) {
            e.preventDefault();

            let original = container.querySelector(".pengeluaran-row");
            let clone = original.cloneNode(true);

            clone.querySelectorAll("input").forEach(input => {
                input.value = "";
            });

            clone.querySelectorAll("select").forEach(select => {
                select.selectedIndex = 0;
            });

            container.appendChild(clone);
        });

        container.addEventListener("click", function(e) {
            if (e.target.closest(".btn-remove")) {
                let rows = container.querySelectorAll(".pengeluaran-row");
                if (rows.length > 1) {
                    e.target.closest(".pengeluaran-row").remove();
                    updateTotal();
                }
            }
        });
    </script>
    <script>
        const dataJenis = @json($daftar_jenis_pengeluaran);

        document.addEventListener("change", function(e) {

            if (e.target.classList.contains("jenis-pengeluaran")) {

                let row = e.target.closest(".pengeluaran-row");
                let itemSelect = row.querySelector(".nama-item");

                let selectedJenis = e.target.value;

                // reset item
                itemSelect.innerHTML = '<option value="">Pilih Nama Item</option>';

                if (!selectedJenis) return;

                let jenis = dataJenis.find(j => j.nama === selectedJenis);

                if (jenis && jenis.item_pengeluaran) {

                    jenis.item_pengeluaran.forEach(item => {

                        let option = document.createElement("option");
                        option.value = item.id;
                        option.textContent = item.nama;

                        itemSelect.appendChild(option);

                    });

                }
            }

        });
    </script>
@endsection
