<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @yield('head')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('/assets/app/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/icons/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/dist/css/admin/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/OwlCarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/OwlCarousel/css/owl.theme.default.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>

        <div class="slider shadow" id="sliderExample">
            <div class="slider-head">
                <div class="slider-profile-image mb-2"
                    style="background-image: url('/images/admins/{{ auth('admins')->user()->avatar }}')"></div>
                {{-- <img src="/images/admins/{{ auth('admins')->user()->avatar }}" alt="admins"
                    class="slider-profile-image mb-2"> --}}
                <div class="lh-1">
                    <p class="text-them fw-bold mb-0">{{ auth('admins')->user()->username }}</p>
                    <small class="text-them-sec">{{ auth('admins')->user()->email }}</small>
                </div>
            </div>
            <div class="slider-body">
                <div class="container">
                    <nav class="nav flex-column">
                        <a class="nav-link slider-link @if (Route::currentRouteName() == 'admin.dashboard') active @endif"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home slider-icons"></i>Dashboard
                        </a>
                        <a class="nav-link slider-link @if (in_array(Route::currentRouteName(), ['admin.profile'])) active @endif"
                            href="{{ route('admin.profile') }}">
                            <i class="fas fa-user slider-icons"></i>Profile
                        </a>
                        <hr class="soft my-2">
                        <a class="nav-link slider-link @if (Route::currentRouteName() == 'admin.transaction') active @endif"
                            href="{{ route('admin.transaction') }}">
                            <i class="fas fa-money-bill slider-icons"></i>Transaction
                        </a>
                        <a class="nav-link slider-link @if (Route::currentRouteName() == 'admin.orders') active @endif"
                            href="{{ route('admin.orders') }}">
                            <i class="fas fa-shopping-bag slider-icons"></i>Orders
                        </a>
                        <hr class="soft my-2">
                        <a class="nav-link slider-link @if (in_array(Route::currentRouteName(), ['admin.product', 'admin.product.create', 'admin.product.update'])) active @endif"
                            href="{{ route('admin.product') }}">
                            <i class="fas fa-boxes slider-icons"></i>Product
                        </a>
                        <hr class="soft my-2">
                        @if (auth('admins')->user()->admin_id == 1)
                            <a class="nav-link slider-link @if (in_array(Route::currentRouteName(), ['admin.account', 'admin.account.create', 'admin.account.update'])) active @endif"
                                href="{{ route('admin.account') }}">
                                <i class="fas fa-users slider-icons"></i>Admins
                            </a>
                        @endif
                        <a class="nav-link slider-link @if (Route::currentRouteName() == 'admin.customer') active @endif"
                            href="{{ route('admin.customer') }}">
                            <i class="fas fa-user slider-icons"></i>Costumer
                        </a>
                        <hr class="soft my-2">
                        <a class="nav-link slider-link" href="#">
                            <i class="fas fa-cog slider-icons"></i>Settings
                        </a>
                        <a class="nav-link slider-link" href="#" id="LogOut">
                            <i class="fas fa-sign-out slider-icons"></i>LogOut
                        </a>

                    </nav>
                </div>
            </div>
        </div>

        <div class="pages">
            @yield('body')
        </div>
    </div>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>


            </div>
        </div>
    </div>


    <div class="sliderBackground" id="sliderBackground"></div>
    <script src="{{ asset('/assets/dist/js/alert.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/jquery.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/app/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/dist/js/admin/panel.js') }}"></script>
    <script src="{{ asset('/assets/OwlCarousel/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Good Jobs!',
                text: '{{ session()->get('success') }}',
                showConfirmButton: false,
                timer: 5000
            })
            location.reload();
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
