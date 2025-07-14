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
    <nav class="navbar navbar-expand-md navbar-purple shadow-lg position-sticky top-0" style="z-index: 1000;">
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
                <a class="btn cart-icon" href="{{ route('cart') }}">
                    <i class="fa fa-shopping-cart"></i>
                </a>
                <!-- Auth -->
                @auth('users')
                    <div class="dropdown">
                        <a class="nav-link d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <img src="/images/avatar/{{ auth('users')->user()->avatar }}" class="rounded-circle avatar-img"
                                width="30" height="30">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-primary" href="{{ route('profile') }}"><i
                                        class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item text-success" href="{{ route('user.order') }}"><i
                                        class="fas fa-box-open me-2"></i> Pesanan Saya</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-outline-purple btn-sm" href="{{ route('login') }}">Masuk</a>
                    <a class="btn btn-purple btn-sm" href="{{ route('signup') }}">Daftar</a>
                @endauth
            </div>
        </div>

        <!-- Main Navbar Content -->
        <div class="collapse navbar-collapse mt-2 mt-md-0" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-md-center gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                        href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}"
                        href="{{ route('product') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                        href="{{ route('about') }}">Tentang</a>
                </li>

                <!-- Cart (Desktop) -->
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link cart-icon" href="{{ route('cart') }}">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </li>

                <!-- Auth (Desktop) -->
                @auth('users')
                    <li class="nav-item dropdown d-none d-md-block">
                        <a class="nav-link d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                            <img src="/images/avatar/{{ auth('users')->user()->avatar }}" class="rounded-circle avatar-img"
                                width="30" height="30">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-primary" href="{{ route('profile') }}"><i
                                        class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                            <li><a class="dropdown-item text-success" href="{{ route('user.order') }}"><i
                                        class="fas fa-box-open me-2"></i> Pesanan Saya</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                        class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item d-none d-md-block">
                        <a class="btn btn-outline-purple btn-sm" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="btn btn-purple btn-sm" href="{{ route('signup') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <main>
        @yield('body')
    </main>


    <footer class="footer-gradient">
        <div class="footer-content">
            <div class="pt-5 pb-4">
                <div class="container pt-5 pb-5">
                    <div class="row g-4 mb-5">
                        <div class="col-12 col-md-7">
                            <div class="about-section me-0 me-md-3">
                                <h4 class="footer-title">
                                    <i class="fas fa-tshirt me-2"></i>Tentang Kami
                                </h4>
                                <p class="footer-text">
                                    Selamat datang di layanan laundry kami! Kami berdedikasi memberikan layanan cuci
                                    terbaik,
                                    cepat, dan bersih. Dengan tenaga profesional dan peralatan modern, kami memastikan
                                    pakaian Anda terawat sempurna. Kepuasan pelanggan adalah prioritas kami. Terima
                                    kasih
                                    telah mempercayakan kebutuhan laundry Anda kepada kami. Kami siap melayani Anda!
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="links-section">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <p class="footer-link-title">
                                            <i class="fas fa-info-circle me-2"></i>Informasi
                                        </p>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="footer-nav-link" href="{{ route('tentang') }}">
                                                    <i class="fas fa-users"></i>Tentang Kami
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="footer-nav-link" href="{{ route('layanan') }}">
                                                    <i class="fas fa-concierge-bell"></i>Layanan Kami
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="footer-nav-link" href="{{ route('carakerja') }}">
                                                    <i class="fas fa-clipboard-list"></i>Cara Pemesanan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <p class="footer-link-title">
                                            <i class="fas fa-headset me-2"></i>Bantuan
                                        </p>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="footer-nav-link" href="{{ route('kontak') }}">
                                                    <i class="fas fa-phone"></i>Kontak Kami
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="footer-nav-link" href="{{ route('keunggulan') }}">
                                                    <i class="fas fa-star"></i>Keunggulan Kami
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="footer-nav-link" href="{{ route('faq') }}">
                                                    <i class="fas fa-question-circle"></i>FAQ
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer-bottom">
                        <hr class="footer-divider">
                        <div
                            class="d-flex flex-column-reverse flex-md-row justify-content-center justify-content-md-between align-items-center">
                            <span class="footer-copyright mb-0 py-2">
                                <i class="fas fa-copyright me-2"></i>Copyrights Bayu ady nugroho ©2025 Website Laundry 
                            </span>
                            <ul class="nav footer-social-links">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://github.com/kobayyy1" title="github">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="https://www.instagram.com/_bayuady_?igsh=eTNqZThwMW5yZjQ="
                                        title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="https://wa.me/+628557584375/?text=Hallo%20Admin%20Laundry" title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
