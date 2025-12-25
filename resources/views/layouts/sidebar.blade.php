<!--  BEGIN SIDEBAR  -->
<aside class="navbar navbar-vertical navbar-expand-lg navbar-transparent">
    <div class="container-fluid">

        <!-- NAVBAR TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- LOGO -->
        <div class="navbar-brand navbar-brand-autodark">
            <a href="/" aria-label="Tabler">
                <img src="{{ asset('assets/img/logo_bertani.jpg') }}" width="220" height="64" alt="Logo Bertani">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">

            <ul class="navbar-nav pt-lg-3">

                <!-- ========================= -->
                <!--         DASHBOARD         -->
                <!-- ========================= -->

                @can('owner')
                    <li class="nav-item text-dark">
                        <a class="nav-link" href="/owner/dashboard">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-1">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title text-dark ">Dashboard</span>
                        </a>
                    </li>
                @endcan

                @can('admin')
                    <li class="nav-item text-dark">
                        <a class="nav-link" href="/admin/dashboard">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-1">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title  text-dark ">Dashboard</span>
                        </a>
                    </li>
                @endcan


                <!-- ========================= -->
                <!--           KEGIATAN        -->
                <!-- ========================= -->

                @php
                    $isKebunOpen =
                        Request::is('pemasukan*') ||
                        Request::is('pengeluaran*') ||
                        Request::is('rekap/*') ||
                        Request::is('keuangan/*');
                @endphp

                <li class="nav-item dropdown text-dark {{ $isKebunOpen ? 'show' : '' }}">
                    <a class="nav-link dropdown-toggle {{ $isKebunOpen ? '' : 'collapsed' }}" href="#"
                        data-bs-toggle="dropdown" data-bs-auto-close="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M15 15l3.35 3.35" />
                                <path d="M9 15l-3.35 3.35" />
                                <path d="M5.65 5.65l3.35 3.35" />
                                <path d="M18.35 5.65l-3.35 3.35" />
                            </svg>
                        </span>
                        <span class="nav-link-title text-dark ">Kebun</span>
                    </a>

                    <div class="dropdown-menu {{ $isKebunOpen ? 'show' : '' }}">

                        <!-- ========================= -->
                        <!--        PEMASUKAN          -->
                        <!-- ========================= -->

                        @php
                            $isPemasukanOpen =
                                Request::is('pemasukan*') ||
                                Request::is('rekap/pemasukan*') ||
                                Request::is('create/kumulatif/pemasukan*');
                        @endphp

                        <div class="dropend {{ $isPemasukanOpen ? 'show' : '' }}">
                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="false">
                                Pemasukan
                            </a>

                            <div class="dropdown-menu {{ $isPemasukanOpen ? 'show' : '' }}">
                                <a href="/pemasukan"
                                    class="dropdown-item {{ Request::is('pemasukan*') || Request::is('create/kumulatif/pemasukan*') ? 'active' : '' }}">
                                    Daftar
                                </a>

                                @can('owner')
                                    <a href="/rekap/pemasukan"
                                        class="dropdown-item {{ Request::is('rekap/pemasukan*') ? 'active' : '' }}">
                                        Rekap
                                    </a>
                                @endcan
                            </div>
                        </div>


                        <!-- ========================= -->
                        <!--       PENGELUARAN         -->
                        <!-- ========================= -->

                        @php
                            $isPengeluaranOpen =
                                Request::is('pengeluaran*') ||
                                Request::is('rekap/pengeluaran*') ||
                                Request::is('create/kumulatif/pengeluaran*');
                        @endphp

                        <div class="dropend {{ $isPengeluaranOpen ? 'show' : '' }}">
                            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                data-bs-auto-close="false">
                                Pengeluaran
                            </a>
                            <div class="dropdown-menu {{ $isPengeluaranOpen ? 'show' : '' }}">
                                <a href="/pengeluaran"
                                    class="dropdown-item {{ Request::is('pengeluaran*') || Request::is('create/kumulatif/pengeluaran*') ? 'active' : '' }}">Daftar</a>

                                @can('owner')
                                    <a href="/rekap/pengeluaran"
                                        class="dropdown-item {{ Request::is('rekap/pengeluaran*') ? 'active' : '' }}">Rekap</a>
                                @endcan
                            </div>
                        </div>

                        <!-- ========================= -->
                        <!--     LAPORAN KEUANGAN     -->
                        <!-- ========================= -->

                        @can('owner')
                            @php
                                $isKeuanganOpen = Request::is('keuangan/*');
                            @endphp

                            <div class="dropend {{ $isKeuanganOpen ? 'show' : '' }}">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    data-bs-auto-close="false">
                                    Laporan Keuangan
                                </a>

                                <div class="dropdown-menu {{ $isKeuanganOpen ? 'show' : '' }}">
                                    <a href="/keuangan/cashflow"
                                        class="dropdown-item {{ Request::is('keuangan/cashflow*') ? 'active' : '' }}">Cashflow</a>
                                    <a href="/keuangan/laba-rugi"
                                        class="dropdown-item {{ Request::is('keuangan/laba-rugi*') ? 'active' : '' }}">Laba
                                        Rugi</a>
                                </div>
                            </div>
                        @endcan

                    </div>
                </li>
            </ul>

            <!-- LOGOUT BUTTON -->
            <div class="mt-auto pt-3 d-flex justify-content-center mb-3">
                <button type="button" class="btn w-80 btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#modal-logout">
                    Logout
                </button>
            </div>

        </div>
    </div>
</aside>

<!--  END SIDEBAR  -->
