<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('head')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('/assets/app/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/icons/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/OwlCarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/OwlCarousel/css/owl.theme.default.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md" id="accordionExample">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Laundryku</a>
            <button class="ms-auto btn d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navSearch">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <a class="btn d-md-none" href="{{ route('cart') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </a>
            <button class="btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#slider">
                <i class="fas fa-bars fa-lg fa-fw"></i>
            </button>
            <div class="collapse flex-grow-1 pt-1" style="flex-basis: 100%;" data-bs-parent="#accordionExample"
                id="navSearch">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" data-bs-parent="#accordionExample">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product') }} ">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }} ">AboutMe</a>
                    </li>
                    <li class="nav-item dropdown md-none">
                        <a class="nav-link" href="#" data-bs-toggle="dropdown">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu box-cart">
                            <div class="d-flex align-items-center px-3 py-2">
                                <i class="fa fa-shopping-cart fa-sm me-2 mb-0" aria-hidden="true"></i>
                                <small class="fw-bold mb-0">Shopping Cart</small>
                            </div>
                            <hr class="soft m-0">
                            <div class="d-block p-2">

                                @if (session('cart'))
                                    <div class="mb-3">
                                        @foreach (session('cart') as $cart)
                                            <div class="row g-2">
                                                <div class="col-3">
                                                    <img src="/images/product/{{ $cart['images'] }}" alt=""
                                                        class="w-100 rounded">
                                                </div>
                                                <div class="col-9">
                                                    <!-- penghapusan produk -->
                                                    <a href="{{ route('product.order.delete', ['id' => $cart['product_id'], 'slug' => $cart['slug']]) }}"
                                                        class="btn btn-sm text-danger position-absolute end-0 me-2">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="lh-0">
                                                        <p class="mb-0 text-truncate">{{ $cart['title'] }}</p>
                                                        <div class="d-flex">
                                                            @if ($cart['discount'] != null && strtotime(date('Y-m-d')) < strtotime($cart['dateDiscountEnd']))
                                                                <p class="mb-0 me-2">
                                                                    Rp.{{ number_format($cart['price_other'], 0, ',', '.') }}
                                                                </p>
                                                                <small class="text-decoration-line-through">
                                                                    Rp.{{ number_format($cart['price']) }}
                                                                </small>
                                                            @else
                                                                <p class="mb-0">
                                                                    Rp.{{ number_format($cart['price_other'], 0, ',', '.') }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end mb-2">
                                        <a href="{{ route('cart') }}" class="btn btn-sm btn-outline-primary">Lihat
                                            Orderan saya</a>
                                    </div>
                                @else
                                    <div class="ratio ratio-1x1">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <i class="fa fa-shopping-basket fa-3x" aria-hidden="true"></i>
                                            <p class="text-secondary">Not Have Product!</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </ul>
                    </li>
                    @php
                        $user = Auth::guard('users')->user();
                    @endphp

                    <div class="d-block d-md-none">
                        <ul class="navbar-nav">
                            @if (!$user)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('signup') }}">Daftar</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown">
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @php
                        $user = Auth::guard('users')->user();
                    @endphp

                    {{-- Bagian desktop --}}
                    @if (!$user)
                        <div class="d-none d-md-flex gap-2 ms-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary py-1"
                                style="width: 120px">Masuk</a>
                            <a href="{{ route('signup') }}" class="btn btn-outline-warning py-1"
                                style="width: 120px">Daftar</a>
                        </div>
                    @else
                        <div class="d-none d-md-flex align-items-center ms-2 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <img src="{{ $user->avatar ?? '/images/default-avatar.png' }}" width="30"
                                    height="30" class="rounded-circle" alt="Avatar">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">
                                        Keluar
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Iya, keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif

    </nav>
    <main>
        @yield('body')
    </main>

    <footer class="bg-primary text-light">
        <div class="pt-5 pb-4">
            <div class="container">
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
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6">
                                <p class="fw-bold">About Link</p>
                                <ul class="nav flex-column">
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
                                    <a class="nav-link link-secondary px-0 link-light" href="#">Link</a>
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

    <script src="{{ asset('/assets/dist/js/alert.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/jquery.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/OwlCarousel/owl.carousel.min.js') }}"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Good Jobs!',
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
    @livewireScripts
</body>

</html>
