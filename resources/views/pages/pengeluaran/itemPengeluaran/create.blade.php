@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        <a href="{{ url()->previous() }}#tabs-items">Kembali</a>
                    </div>
                    <h2 class="page-title">
                        Tambah Data Item Pengeluaran
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
                        <form class="space-y" method="POST" action="/item-pengeluaran" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4"><label class="form-label">Jenis Pengeluaran*</label></div>
                                <div class="col-3"><label class="form-label">Nama Item*</label></div>
                            </div>
                            <div id="item-container">
                                @php
                                    $itemOld = old('nama_item', ['']); // minimal 1 baris
                                @endphp

                                @foreach ($itemOld as $i => $item)
                                    <div class="row mb-1 item-row">
                                        <div class="col-4">
                                            <select name="jenis_pengeluaran[]"
                                                class="form-select produk-select @error('jenis_pengeluaran.' . $i) is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Jenis Pengeluaran</option>
                                                @foreach ($daftar_jenis_pengeluaran as $jenis)
                                                    <option value="{{ $jenis->id }}"
                                                        {{ old('jenis_pengeluaran.' . $i) == $jenis->id ? 'selected' : '' }}>
                                                        {{ $jenis->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <input type="text" name="nama_item[]"
                                                class="form-control @error('nama_item.' . $i) is-invalid @enderror"
                                                value="{{ old('nama_item.' . $i) }}" placeholder="Masukkan nama item"
                                                required>

                                            <p class="invalid-feedback">
                                                {{ $errors->first('nama_item.' . $i) }}
                                            </p>
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
                                    <a href="#" id="btn-tambah-item" class="btn btn-primary d-none d-sm-inline-block">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah Lainnya
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
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
        document.addEventListener("DOMContentLoaded", function() {

            const container = document.getElementById("item-container");

            // Add new product row
            document.getElementById("btn-tambah-item").addEventListener("click", function(e) {
                e.preventDefault();

                let original = container.querySelector(".item-row");
                let clone = original.cloneNode(true);

                clone.querySelectorAll("input").forEach(input => {
                    input.value = "";
                });

                container.appendChild(clone);
            });

            // Delete row
            container.addEventListener("click", function(e) {
                if (e.target.closest(".btn-remove")) {
                    let rows = container.querySelectorAll(".item-row");
                    if (rows.length > 1) {
                        e.target.closest(".item-row").remove();
                    }
                }
            });

        });
    </script>
@endsection
