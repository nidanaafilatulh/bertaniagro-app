@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <a href="/pemasukan">Daftar Pemasukan</a>
                    </div>
                    <h2 class="page-title">
                        Tambah Data Transaksi Pemasukan
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
                        <form class="space-y" method="POST" action="/pemasukan" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-5 me-6">
                                    <label class="form-label">
                                        Pelanggan
                                    </label>
                                    <input type="text" name="pelanggan" id="pelanggan"
                                        placeholder="Masukkan nama pelanggan"
                                        class="form-control @error('pelanggan') is-invalid @enderror" id="pelanggan"
                                        name="pelanggan" value="{{ old('pelanggan') }}" required>
                                    @error('pelanggan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-5 ms-8">
                                    <label class="form-label">
                                        Tanggal Transaksi Pemasukan
                                    </label>
                                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                        placeholder="Pilih tanggal" class="form-control"
                                        value="{{ old('tanggal_transaksi', $tanggal) }}" required>
                                </div>
                                <input type="hidden" name="no_transaksi" value="{{ $nextNo }}">
                            </div>
                            <div class="row mt-4">
                                <div class="col-3"><label class="form-label">Produk</label></div>
                                <div class="col-2"><label class="form-label">Kuantitas</label></div>
                                <div class="col-2"><label class="form-label">Satuan</label></div>
                                <div class="col-2"><label class="form-label">Harga Satuan</label></div>
                                <div class="col-3"><label class="form-label">Jumlah</label></div>
                            </div>
                            <div id="produk-container">
                                @php
                                    $produkOld = old('produk', ['']); // minimal 1 baris
                                @endphp

                                @foreach ($produkOld as $i => $p)
                                    <div class="row mb-1 produk-row">
                                        <div class="col-3">
                                            <input type="text" name="produk[]"
                                                class="form-control @error('produk.*') is-invalid @enderror"
                                                value="{{ old('produk.' . $i) }}" placeholder="Masukkan produk" required>
                                        </div>
                                        <div class="col-2">
                                            <input type="number" step="0.01" name="kuantitas[]"
                                                class="form-control @error('kuantitas.*') is-invalid @enderror"
                                                value="{{ old('kuantitas.' . $i) }}" placeholder="Masukkan kuantitas"
                                                required>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="satuan[]"
                                                class="form-control @error('satuan.*') is-invalid @enderror"
                                                value="{{ old('satuan.' . $i) }}" placeholder="Masukkan satuan" required>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" name="harga_satuan[]"
                                                class="form-control harga-format @error('harga_satuan.*') is-invalid @enderror"
                                                value="{{ old('harga_satuan.' . $i) }}" placeholder="Masukkan harga satuan"
                                                required>
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control jumlah" name="jumlah[]"
                                                value="{{ old('jumlah.' . $i) }}" readonly>
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn-remove border-0 bg-transparent mt-1">
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
                                    <a href="#" id="btn-tambah-produk"
                                        class="btn btn-primary d-none d-sm-inline-block">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah Produk
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    <label class="form-label">Upload Bukti Bayar (JPG/PNG)</label>
                                    <p>Maksimum size file 10 Mb</p>
                                    <input type="file" name="bukti_bayar"
                                        class="form-control @error('bukti_bayar') is-invalid @enderror">
                                    @error('bukti_bayar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6">
                                    <label class="form-label">
                                        <h2>Total Keseluruhan: <span
                                                id="total-keseluruhan">{{ old('total_keseluruhan') ?? 0 }}</span></h2>
                                        <input type="number" name="total_keseluruhan" id="total_keseluruhan_input"
                                            value="{{ old('total_keseluruhan') }}" hidden>
                                    </label>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary btn-3">Simpan</button>
                                    </div>
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
        // Convert number to Rp format
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka).replace(",00", "");
        }

        document.addEventListener("DOMContentLoaded", function() {

            const container = document.getElementById("produk-container");
            const totalDisplay = document.getElementById("total-keseluruhan");
            const totalInput = document.getElementById("total_keseluruhan_input");

            // Format harga on typing
            document.addEventListener("input", function(e) {
                if (e.target.classList.contains("harga-format")) {
                    let clean = e.target.value.replace(/[^0-9]/g, "");
                    e.target.value = clean ? formatRupiah(clean) : "";
                }
            });

            // Update jumlah in a row
            function updateJumlah(row) {
                let qty = parseFloat(row.querySelector('input[name="kuantitas[]"]').value) || 0;
                let hargaText = row.querySelector('input[name="harga_satuan[]"]').value;

                // Extract raw number from Rp text
                let harga = parseFloat(hargaText.replace(/[^0-9]/g, "")) || 0;

                let jumlahInput = row.querySelector(".jumlah");
                let jumlah = qty * harga;
                jumlahInput.value = formatRupiah(jumlah);

                updateTotal();
            }

            // Update total keseluruhan
            function updateTotal() {
                let total = 0;

                document.querySelectorAll(".jumlah").forEach(j => {
                    let raw = j.value.replace(/[^0-9]/g, "");
                    total += parseInt(raw) || 0;
                });

                totalDisplay.textContent = formatRupiah(total);
                totalInput.value = total;
            }

            // Detect changes in row
            container.addEventListener("input", function(e) {
                if (
                    e.target.name === "kuantitas[]" ||
                    e.target.name === "harga_satuan[]"
                ) {
                    updateJumlah(e.target.closest(".produk-row"));
                }
            });

            // Add new product row
            document.getElementById("btn-tambah-produk").addEventListener("click", function(e) {
                e.preventDefault();

                let original = container.querySelector(".produk-row");
                let clone = original.cloneNode(true);

                clone.querySelectorAll("input").forEach(input => {
                    input.value = "";
                });

                container.appendChild(clone);
            });

            // Delete row
            container.addEventListener("click", function(e) {
                if (e.target.closest(".btn-remove")) {
                    let rows = container.querySelectorAll(".produk-row");
                    if (rows.length > 1) {
                        e.target.closest(".produk-row").remove();
                        updateTotal();
                    }
                }
            });

        });
    </script>
@endsection
