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
                        Tambah Data Jenis Pengeluaran
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
                        <form class="space-y" method="POST" action="/jenis-pengeluaran" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4"><label class="form-label">Nama Jenis Pengeluaran*</label></div>
                            </div>
                            <div id="jenis-container">
                                @php
                                    $jenisOld = old('nama_jenis_pengeluaran', ['']); // minimal 1 baris
                                @endphp

                                @foreach ($jenisOld as $i => $item)
                                    <div class="row mb-1 jenis-row">
                                        <div class="col-11">
                                            <input type="text" name="nama_jenis_pengeluaran[]"
                                                class="form-control @error('nama_jenis_pengeluaran.*') is-invalid @enderror"
                                                value="{{ old('nama_jenis_pengeluaran.' . $i) }}" placeholder="Masukkan nama jenis pengeluaran" required>
                                            <p class="invalid-feedback">{{ $errors->first('nama_jenis_pengeluaran.' . $i) }}</p>
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
                                    <a href="#" id="btn-tambah-jenis"
                                        class="btn btn-primary d-none d-sm-inline-block">
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

            const container = document.getElementById("jenis-container");
          
            // Add new product row
            document.getElementById("btn-tambah-jenis").addEventListener("click", function(e) {
                e.preventDefault();

                let original = container.querySelector(".jenis-row");
                let clone = original.cloneNode(true);

                clone.querySelectorAll("input").forEach(input => {
                    input.value = "";
                });

                container.appendChild(clone);
            });

            // Delete row
            container.addEventListener("click", function(e) {
                if (e.target.closest(".btn-remove")) {
                    let rows = container.querySelectorAll(".jenis-row");
                    if (rows.length > 1) {
                        e.target.closest(".jenis-row").remove();
                    }
                }
            });

        });
    </script>
@endsection
