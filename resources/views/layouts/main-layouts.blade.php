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
</head>

<body>
    @yield('container')

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/dist/js/tabler.js') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('preview/js/demo.js') }}" defer></script>
    <!-- END DEMO SCRIPTS -->

</body>

</html>
