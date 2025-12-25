@extends('layouts.pages-layouts')

@section('container')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Selamat Datang {{ $user->name }} Owner Bertani Agrofarm
                    </h2>
                    <div class="page-pretitle">
                        {{ $tanggal_hari_ini }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="col-12">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm h-100">
                            <a href="/rekap/pemasukan" class="text-decoration-none text-dark">
                                <div class="card-body ">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-file-description">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm3 14h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2" />
                                                    <path d="M19 7h-4l-.001 -4.001z" />
                                                </svg></span>
                                        </div>
                                        <div class="col">
                                            <div class="h1 mb-0">Rekap Pemasukan</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm">
                            <a href="/rekap/pengeluaran" class="text-decoration-none text-dark">
                                <div class="card-body ">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-file-description">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm3 14h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2" />
                                                    <path d="M19 7h-4l-.001 -4.001z" />
                                                </svg></span>
                                        </div>
                                        <div class="col">
                                            <div class="h1 mb-0">Rekap Pengeluaran</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm h-100">
                            <a href="/keuangan/cashflow" class="text-decoration-none text-dark">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-file-description">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm3 14h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2" />
                                                    <path d="M19 7h-4l-.001 -4.001z" />
                                                </svg></span>
                                        </div>
                                        <div class="col">
                                            <div class="h1 mb-0">Cashflow</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-sm h-100">
                            <a href="/keuangan/laba-rugi" class="text-decoration-none text-dark">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span
                                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="currentColor"
                                                    class="icon icon-tabler icons-tabler-filled icon-tabler-file-description">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M12 2l.117 .007a1 1 0 0 1 .876 .876l.007 .117v4l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h4l.117 .007a1 1 0 0 1 .876 .876l.007 .117v9a3 3 0 0 1 -2.824 2.995l-.176 .005h-10a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-14a3 3 0 0 1 2.824 -2.995l.176 -.005zm3 14h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2" />
                                                    <path d="M19 7h-4l-.001 -4.001z" />
                                                </svg></span>
                                        </div>
                                        <div class="col">
                                            <div class="h1 mb-0">Laba Rugi</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mt-7 justify-content-center">
                <!-- Card Pemasukan -->
                <div class="col-md-6">
                    <a href="/pemasukan/create" class="text-decoration-none">
                        <div class="card" style="height: 180px;">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-checkup-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 14h.01" />
                                            <path d="M9 17h.01" />
                                            <path d="M12 16l1 1l3 -3" />
                                        </svg>
                                    </span>
                                    <div class="h2 mb-0">Catat Transaksi Pemasukan</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Card Pengeluaran -->
                <div class="col-md-6">
                    <a href="/pengeluaran/create" class="text-decoration-none">
                        <div class="card" style="height: 180px;">
                            <div class="card-body d-flex justify-content-center align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="bg-primary text-white avatar me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-checkup-list">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 14h.01" />
                                            <path d="M9 17h.01" />
                                            <path d="M12 16l1 1l3 -3" />
                                        </svg>
                                    </span>
                                    <div class="h2 mb-0">Catat Transaksi Pengeluaran</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik Pemasukan dan Pengeluaran</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <form method="GET" action="/owner/dashboard">
                                <div class="d-flex flex-wrap align-items-end justify-content-between">
                                    <div class="d-flex align-items-end">
                                        <div class="me-2 mb-2">
                                            <label class="form-label fw-semibold mb-1">Tanggal Mulai</label>
                                            <input type="date" name="tanggal_mulai" class="form-control"
                                                value="{{ $tanggal_mulai }}" required>
                                        </div>

                                        <div class="me-2 mb-2">
                                            <label class="form-label fw-semibold mb-1">Tanggal Akhir</label>
                                            <input type="date" name="tanggal_akhir" class="form-control"
                                                value="{{ $tanggal_akhir }}" required>
                                        </div>

                                        <div class="mb-2">
                                            <button class="btn btn-primary" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div id="chart-active-users-2"></div>
                            </div>
                            <div class="col-md-auto">
                                <div class="divide-y divide-y-fill">
                                    <div class="px-3">
                                        <div class="text-secondary">
                                            <span class="status-dot bg-primary"></span> Pemasukan
                                        </div>
                                        <div class="h2">{{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="px-3">
                                        <div class="text-secondary">
                                            <span class="status-dot bg-danger"></span> Pengeluaran
                                        </div>
                                        <div class="h2">{{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="px-3">
                                        <div class="text-secondary">
                                            <span class="status-dot bg-green"></span> Laba Rugi
                                        </div>
                                        <div class="h2">{{ number_format($labaRugi, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE BODY -->
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.ApexCharts &&
                new ApexCharts(document.getElementById("chart-active-users-2"), {
                    chart: {
                        type: "line",
                        fontFamily: "inherit",
                        height: 288,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false,
                        },
                        animations: {
                            enabled: false,
                        },
                    },
                    stroke: {
                        width: 2,
                        lineCap: "round",
                        curve: "smooth",
                    },
                    series: [{
                            name: "Mobile",
                            data: [
                                4164, 4652, 4817, 4841, 4920, 5439, 5486, 5498, 5512, 5538, 5841, 5877,
                                6086, 6146, 6199, 6431, 6704, 7939, 8127, 8296, 8322, 8389, 8411,
                                8502, 8868, 8977, 9273, 9325, 9345, 9430,
                            ],
                        },
                        {
                            name: "Desktop",
                            data: [
                                2164, 2292, 2386, 2430, 2528, 3045, 3255, 3295, 3481, 3604, 3688, 3840,
                                3932, 3949, 4003, 4298, 4424, 4869, 4922, 4973, 5155, 5267, 5566,
                                5689, 5692, 5758, 5773, 5799, 5960, 6000,
                            ],
                        },
                        {
                            name: "Tablet",
                            data: [
                                1069, 1089, 1125, 1141, 1162, 1179, 1185, 1216, 1274, 1322, 1346, 1395,
                                1439, 1564, 1581, 1590, 1656, 1815, 1868, 2010, 2133, 2179, 2264,
                                2265, 2278, 2343, 2354, 2456, 2472, 2480,
                            ],
                        },
                    ],
                    tooltip: {
                        theme: "dark",
                    },
                    grid: {
                        padding: {
                            top: -20,
                            right: 0,
                            left: -4,
                            bottom: -4,
                        },
                        strokeDashArray: 4,
                    },
                    xaxis: {
                        labels: {
                            padding: 0,
                        },
                        tooltip: {
                            enabled: false,
                        },
                        type: "datetime",
                    },
                    yaxis: {
                        labels: {
                            padding: 4,
                        },
                    },
                    labels: [
                        "2020-06-21",
                        "2020-06-22",
                        "2020-06-23",
                        "2020-06-24",
                        "2020-06-25",
                        "2020-06-26",
                        "2020-06-27",
                        "2020-06-28",
                        "2020-06-29",
                        "2020-06-30",
                        "2020-07-01",
                        "2020-07-02",
                        "2020-07-03",
                        "2020-07-04",
                        "2020-07-05",
                        "2020-07-06",
                        "2020-07-07",
                        "2020-07-08",
                        "2020-07-09",
                        "2020-07-10",
                        "2020-07-11",
                        "2020-07-12",
                        "2020-07-13",
                        "2020-07-14",
                        "2020-07-15",
                        "2020-07-16",
                        "2020-07-17",
                        "2020-07-18",
                        "2020-07-19",
                        "2020-07-20",
                    ],
                    colors: [
                        "color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
                        "color-mix(in srgb, transparent, var(--tblr-azure) 100%)",
                        "color-mix(in srgb, transparent, var(--tblr-green) 100%)",
                    ],
                    legend: {
                        show: false,
                    },
                }).render();
        });
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new ApexCharts(document.getElementById("chart-active-users-2"), {
                chart: {
                    type: "line",
                    height: 300,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                        name: "Pemasukan",
                        data: dataPemasukan
                    },
                    {
                        name: "Pengeluaran",
                        data: dataPengeluaran
                    },
                    {
                        name: "Laba Rugi",
                        data: dataLabaRugi
                    },
                ],
                xaxis: {
                    categories: chartLabels,
                    type: "datetime"
                },
                stroke: {
                    width: 3,
                    curve: "smooth",
                },
                colors: [
                    "color-mix(in srgb, transparent, var(--tblr-primary) 100%)",
                    "color-mix(in srgb, transparent, var(--tblr-red) 100%)",
                    "color-mix(in srgb, transparent, var(--tblr-green) 100%)",
                ],
                tooltip: {
                    theme: "dark"
                }
            }).render();
        });
    </script>
    <script>
        const chartLabels = @json($labels);
        const dataPemasukan = @json($pemasukan_chart);
        const dataPengeluaran = @json($pengeluaran_chart);
        const dataLabaRugi = @json($labaRugi_chart);
    </script>
@endsection
