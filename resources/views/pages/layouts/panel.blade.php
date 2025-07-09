<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @yield('head')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/assets/app/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/icons/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/OwlCarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/OwlCarousel/css/owl.theme.default.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
        @include('pages.layouts.style')
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm position-sticky top-0 z-3">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Toggle (collapse) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Brand -->
            <a class="navbar-brand fw-bold me-auto ms-2" href="#">Laundryku</a>

            <!-- Mobile Right (cart + auth) -->
            <div class="d-flex align-items-center gap-2 d-md-none">
                <!-- Cart -->
                <a class="btn" href="{{ route('cart') }}">
                    <i class="fa fa-shopping-cart"></i>
                </a>
                <!-- Auth -->
                @auth('users')
                    <div class="dropdown">
                        <a class="nav-link d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <img src="/images/avatar/{{ auth('users')->user()->avatar }}" class="rounded-circle"
                                width="30" height="30">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-primary" href="{{ route('profile') }}"><i
                                        class="fas fa-user-circle"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item text-success" href="{{ route('user.order') }}"><i
                                        class="fas fa-box-open"></i> Pesanan Saya</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt"></i> Keluar</a></li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Masuk</a>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('signup') }}">Daftar</a>
                @endauth
            </div>
        </div>
        <!-- Main Navbar Content -->
        <div class="collapse navbar-collapse mt-2 mt-md-0" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-md-center gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                        href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}"
                        href="{{ route('product') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">AboutMe</a>
                </li>

                <!-- Cart (Desktop) -->
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="{{ route('cart') }}">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </li>
                <!-- Auth (Desktop) -->
                @auth('users')
                    <li class="nav-item dropdown d-none d-md-block">
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <img src="/images/avatar/{{ auth('users')->user()->avatar }}" class="rounded-circle"
                                width="30" height="30">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-primary" href="{{ route('profile') }}"><i
                                        class="fas fa-user-circle"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item text-success" href="{{ route('user.order') }}"><i
                                        class="fas fa-box-open"></i> Pesanan Saya</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt"></i> Keluar</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-none d-md-block">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('signup') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <main>
        @yield('body')
    </main>


    <footer class="bg-primary text-light">
        <div class="pt-5 pb-4">
            <div class="container pt-5 pb-5">
                <div class="row g-4 mb-5">
                    <div class="col-12 col-md-7">
                        <div class="me-0 me-md-5">
                            <h4 class="fw-bold">About Me</h4>
                            <p>Selamat datang di layanan laundry kami! Kami berdedikasi memberikan layanan cuci terbaik,
                                cepat, dan bersih. Dengan tenaga profesional dan peralatan modern, kami memastikan
                                pakaian Anda terawat sempurna. Kepuasan pelanggan adalah prioritas kami. Terima kasih
                                telah mempercayakan kebutuhan laundry Anda kepada kami. Kami siap melayani Anda!</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p class="fw-bold">About Link</p>
                                <ul class="nav flex-column">
                                    <a class="nav-link link-secondary px-0 link-light"
                                        href="{{ route('tentang') }} ">Tentang Kami</a>
                                    <a class="nav-link link-secondary px-0 link-light"
                                        href="{{ route('layanan') }} ">Layanan Kami</a>
                                    <a class="nav-link link-secondary px-0 link-light"
                                        href="{{ route('carakerja') }} ">Cara Pemesanan</a>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="fw-bold">About Link</p>
                                <ul class="nav flex-column">
                                    <a class="nav-link link-secondary px-0 link-light"
                                        href="{{ route('kontak') }} ">Kontak Kami</a>
                                    <a class="nav-link link-secondary px-0 link-light"
                                        href="{{ route('keunggulan') }} ">Keunggulan Kami</a>
                                    <a class="nav-link link-secondary px-0 link-light"
                                        href=" {{ route('faq') }}">FAQ</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block">
                    <hr class="soft">
                    <div
                        class="d-flex flex-column-reverse flex-md-row justify-content-center justify-content-md-between align-items-center">
                        <span class="mb-0 py-2 text-center text-light">Copyrights ©2025 Website Laundry</span>
                        <ul class="nav">
                            <a class="nav-link link-light" href="#">Link</a>
                            <a class="nav-link link-light" href="#">Link</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="slider" style="width: 22rem">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

        </div>
    </div>

    <script src="{{ asset('/assets/dist/js/index.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/alert.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/jquery.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/OwlCarousel/owl.carousel.min.js') }}"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succes',
                text: '{{ session()->get('success') }}',
                showConfirmButton: false,
                timer: 5000
            })
        </script>
    @elseif(session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Opps...!',
                text: '{{ session()->get('error') }}',
                showConfirmButton: false,
                timer: 5000
            })
        </script>
    @endif
    @yield('script')
</body>

</html>
