<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>BertaniAgro-CashApp | {{ $title }}</title>

    <link rel="icon" href="./favicon-dev.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon-dev.ico" type="image/x-icon" />

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/dist/libs/jsvectormap/dist/jsvectormap.css?1760161510') }}" rel="stylesheet" />
    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/dist/css/tabler.css?1760161510') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PLUGINS STYLES -->
    <link href="{{ asset('assets/dist/css/tabler-flags.css?1760161510') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-socials.css?1760161510') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-payments.css?1760161510') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-vendors.css?1760161510') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-marketing.css?1760161510') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/tabler-themes.css?1760161510') }}" rel="stylesheet" />
    <!-- END PLUGINS STYLES -->

    <!-- BEGIN DEMO STYLES -->
    <link href="{{ asset('preview/css/demo.css?1760161510') }}" rel="stylesheet" />
    <!-- END DEMO STYLES -->

    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url('https://rsms.me/inter/inter.css');
    </style>
    <!-- END CUSTOM FONT -->
    <script type="module"
        integrity="sha512-I1nWw2KfQnK/t/zOlALFhLrZA1yzsCzBl7DxamXdg/QF7kq+O4sYBZLl0DFCE7vP2ixPccL/k0/oqvhyDB73zQ=="
        src="/.11ty/reload-client.js"></script>
        
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('assets/dist/js/tabler-theme.js') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->

    <div class="page">
        @include('layouts.sidebar')

        <div class="page-wrapper">

            @yield('container')

            <!--  BEGIN FOOTER  -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="https://docs.tabler.io" target="_blank"
                                        class="link-secondary" rel="noopener">Documentation</a></li>
                                <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                                </li>
                                <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank"
                                        class="link-secondary" rel="noopener">Source code</a></li>
                                <li class="list-inline-item">
                                    <a href="https://github.com/sponsors/codecalm" target="_blank"
                                        class="link-secondary" rel="noopener">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/heart -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon text-pink icon-inline icon-4">
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                        </svg>
                                        Sponsor
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; 2025
                                    <a href="." class="link-secondary">Tabler</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">

                                    Generated 2025-10-11 12:45 +0000

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!--  END FOOTER  -->
        </div>
    </div>

    @yield('modal')


    <!-- BEGIN PAGE LIBRARIES -->
    <script src="{{ asset('assets/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('assets/dist/libs/jsvectormap/dist/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
    <script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
    <!-- END PAGE LIBRARIES -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/dist/js/tabler.js') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('preview/js/demo.js') }}" defer></script>
    <!-- END DEMO SCRIPTS -->

    <!-- BEGIN PAGE SCRIPTS -->
    <div class="modal modal-blur fade" id="modal-logout" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">Logout</div>
                    <div>Apakah kamu yakin ingin keluar?</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END PAGE SCRIPTS -->
</body>

</html>
