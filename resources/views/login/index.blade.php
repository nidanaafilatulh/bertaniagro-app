@extends('layouts.main-layouts')

@section('container')
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="./assets/dist/js/tabler-theme.js"></script>
    <!-- END GLOBAL THEME SCRIPT -->

    <div class="row g-0 flex-fill">
        <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px-lg-5">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="text-center">
                    <!-- BEGIN NAVBAR LOGO -->
                    <a href="." aria-label="Tabler"class="navbar-brand navbar-brand-autodark">
                        <img src="./assets/img/logo_bertani.jpg" width="220" height="64" alt="Logo Bertani">
                    </a><!-- END NAVBAR LOGO -->
                </div>

                <h2 class="h3 text-center mb-3">
                    Masuk ke Aplikasi
                </h2>

                <form action="/login" method="post" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan alamat email" autocomplete="off" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Kata Sandi
                            {{-- <span class="form-label-description">
                                <a href="./forgot-password.html">I forgot password</a>
                            </span> --}}
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukan kata sandi" autocomplete="off" required>
                            <span class="input-group-text">
                                <a href="#" id="togglePassword" class="link-secondary" title="Show password"
                                    data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg></a>
                            </span>
                        </div>

                    </div>
                    {{-- <div class="mb-2">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" />
                            <span class="form-check-label">Remember me on this device</span>
                        </label>
                    </div> --}}

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
            <!-- Photo -->
            <div class="bg-cover h-100 min-vh-100" style="background-image: url(./assets/img/background.jpg)">
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            e.preventDefault();

            const passwordInput = document.getElementById('password');

            // Toggle the type attribute
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    </script>
@endsection
