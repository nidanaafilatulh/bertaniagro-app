@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <a href="/pengeluaran">Daftar Pengeluaran</a>
                    </div>
                    <h2 class="page-title">
                        Tambah Data Transaksi Pengeluaran
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
                        <form class="space-y" action="/pengeluaran" method="POST">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label class="form-label">Tanggal Transaksi Pengeluaran</label>
                                    <input type="date" placeholder="Pilih tanggal" class="form-control" name="tanggal"
                                        id="tanggal" value="{{ old('tanggal', $tanggal) }}" required>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Jenis Pengeluaran</label>
                                    <input type="text" placeholder="Masukkan jenis pengeluaran"
                                        class="form-control @error('jenis_pengeluaran') is-invalid @enderror"
                                        id="jenis_pengeluaran" name="jenis_pengeluaran"
                                        value="{{ old('jenis_pengeluaran') }}" required>

                                    @error('jenis_pengeluaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-3">
                                    <label class="form-label">Nama Item</label>
                                    <input type="text" placeholder="Masukkan nama item"
                                        class="form-control @error('nama_item') is-invalid @enderror" id="nama_item"
                                        name="nama_item" value="{{ old('nama_item') }}" required>

                                    @error('nama_item')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" placeholder="Masukkan keterangan"
                                        class="form-control @error('deskripsi') is-invalid @enderror" id="keterangan"
                                        name="keterangan" value="{{ old('keterangan') }}">
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <label class="form-label">Kuantitas</label>
                                    <input type="number" step="0.01" placeholder="Masukkan kuantitas"
                                        class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas"
                                        name="kuantitas" value="{{ old('kuantitas') }}" required>

                                    @error('kuantitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <label class="form-label">Harga per-Item</label>
                                    <input type="text" placeholder="Masukkan harga"
                                        class="form-control @error('harga_per_item') is-invalid @enderror"
                                        id="harga_per_item" name="harga_per_item" oninput="formatRupiah(this)"
                                        value="{{ old('harga_per_item') }}" required>

                                    @error('harga_per_item')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-2">
                                    <label class="form-label">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" id="jumlah"
                                        value="{{ old('jumlah') }}" readonly>
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
        const qty = document.getElementById('kuantitas');
        const harga = document.getElementById('harga_per_item');
        const jumlah = document.getElementById('jumlah');

        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, "");

            if (value === "") {
                input.value = "";
                return;
            }

            input.value = "Rp " + new Intl.NumberFormat('id-ID').format(value);
        }

        function hitungJumlah() {
            let q = parseFloat(qty.value) || 0;

            // Clean harga string
            let hRaw = harga.value.replace(/[^0-9]/g, "");
            let h = parseFloat(hRaw) || 0;

            jumlah.value = "Rp " + new Intl.NumberFormat('id-ID').format(q * h);
        }

        qty.addEventListener('input', hitungJumlah);
        harga.addEventListener('input', function() {
            formatRupiah(this);
            hitungJumlah();
        });
    </script>
    {{-- <script>
        function formatRupiah(input) {
            // Remove non-digit characters
            let value = input.value.replace(/[^0-9]/g, "");

            if (value === "") {
                input.value = "";
                return;
            }

            // Format number with thousand separators
            let formatted = new Intl.NumberFormat('id-ID').format(value);

            // Add "Rp " prefix
            input.value = "Rp " + formatted;
        }
    </script> --}}
@endsection
