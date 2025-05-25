@extends('pages.layouts.panel')

@section('head')
    <title>laundry aplikasi terbaik indonesia</title>
    <style>
        .banner1 {
            background-image: url('/images/banner/banner2.png');
            background-position: top;
            background-size: cover;
        }

        .product-card {
            width: 25rem;
            overflow: hidden;
        }

        .product-card-image {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        @media(max-width: 576px) {
            .product-card {
                width: 21rem;
            }
        }
    </style>
@endsection

@section('body')
    <div class="py-5 banner1">
        <div class="container">
            <div class="row gy-5 gy-md-0 justify-content-between align-items-center">
                <div class="col-12 col-md-6 order-2 order-md-1">
                    <h1 class="display-4 fw-bold mb-4">Dapatkan Laundry Sekarang Juga</h1>
                    <p class="mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus perspiciatis molestias
                        assumenda
                        quaerat cum, quo eos, temporibus necessitatibus ipsam.</p>
                    <a href="#" class="btn btn-primary btn-lg px-5">Daftar Sekarang</a>
                </div>
                <div class="col-12 col-md-5 order-1 order-md-2">
                    <img src="{{ url('/images/banner/laundrybanner1.png') }}" alt="bannerlaundry" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="pt-5 pb-4 py-md-5">
        <div class="container pt-2 pb-5">
            <div class="d-block mb-5">
                <h2 class="fw-bold mb-0">Pake Murah Laundry</h2>
                <p class="mb-0">Lorem ipsum sint excepturi architecto
                    voluptatibus praesentium unde voluptas animi.</p>
            </div>

            {{-- <div class="d-block d-md-none"> --}}
            <div id="owl-one" class="owl-carousel owl-theme owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage d-flex">

                        @foreach ($product as $index => $item)
                            <div class="owl-item d-flex align-self-stretch">
                                <div class="card product-card">
                                    <div class="product-card-image ratio ratio-4x3"
                                        style="background-image: url('/images/product/{{ $item->image }}')"></div>
                                    <div class="card-body py-4">
                                        <div class="card-titles mb-2">
                                            <h5 class="mb-0">{{ $item->title }}</h5>
                                            <p class="mb-0">{{ $item->description }}</p>
                                        </div>
                                        <div class="card-price mb-3">
                                            @if ($item->discount != null && strtotime(date('Y-m-d')) < strtotime($item->dateDiscountEnd))
                                                <div class="mb-2">
                                                    <span class="text-decoration-line-through">Rp.
                                                        {{ number_format($item->price) }}</span>
                                                    <span class="badge rounded-pill text-bg-primary">Diskon
                                                        {{ $item->discount }}%</span>
                                                </div>
                                                <div class="d-flex align-items-end">
                                                    <span class="fs-4 mb-1">Rp.</span>
                                                    <span
                                                        class="fw-bold fs-1">{{ number_format($item->price_other) }}</span>
                                                    <span class="fs-4 mb-1">/Kg</span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-end" style="padding-top: 2rem">
                                                    <span class="fs-4 mb-1">Rp.</span>
                                                    <span
                                                        class="fw-bold fs-1">{{ number_format($item->price_other) }}</span>
                                                    <span class="fs-4 mb-1">/Kg</span>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('product.order', ['id' => $item->product_id, 'slug' => $item->slug]) }}" class="btn btn-outline-primary btn-lg w-100 mb-4">Pilih paket</a>
                                        <hr class="soft">
                                        <ul style="list-style: none" class="px-2">
                                            @foreach ($item->descriptionList as $items)
                                                <li class="d-flex mb-2">
                                                    <i class="fas fa-check text-success me-3" aria-hidden="true"></i>
                                                    <span class="mb-0">{{ $items }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="py-5" style="background-color: rgb(240, 240, 240)">
        <div class="container">
            <div class="text-center py-3">
                <h1>Buruan Daftar Laundryku</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum quod eum reprehenderit, rerum ullam culpa
                    hic ab placeat natus consectetur voluptates excepturi</p>
                <button class="btn btn-outline-primary btn-lg px-5">DAFTAR</button>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row g-4 align-items-center justify-content-center mb-4">
                <div class="col-12 col-lg-6 order-2">
                    <div class="text-center text-lg-start">
                        <h1 class="">Mengapa Harus Laundry di Laundryku</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium libero quos nihil neque illo
                            aliquid magnam similique eligendi non quibusdam, deleniti velit asperiores possimus, voluptatem
                            illum laborum consectetur! Corrupti, atque!</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-lg-2">
                    <img class="ratio ratio-1x1" src="{{ url('/images/content/Laundry3.jpeg') }}" alt="paket1">
                </div>
            </div>
            <div class="row g-4 align-items-center justify-content-center mb-4">
                <div class="col-12 col-lg-6">
                    <img class="ratio ratio-1x1" src="{{ url('/images/content/Laundry4.jpg') }}" alt="paket1">
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text-center text-lg-start">
                        <h1 class="">Kenali dahulu sebelum laundry pakaian</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium libero quos nihil neque illo
                            aliquid magnam similique eligendi non quibusdam, deleniti velit asperiores possimus, voluptatem
                            illum laborum consectetur! Corrupti, atque!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5" style="background-color: rgb(240, 240, 240)">
        <div class="container pb-3">
            <div class="title-partner mb-4">
                <h5 class="fw-bold">Partner Laundryku</h5>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia at dicta enim quasi.</p>
            </div>
            <div class="row g-4">
                @for ($x = 0; $x < 8; $x++)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="alert alert-secondary mb-0" role="alert">
                            A simple secondary alert—check it out!
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container py-4">
            <div class="title-testimony text-center mb-4">
                <h5 class="fw-bold">User Testimonial</h5>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia at dicta enim quasi.</p>
            </div>
            <div id="owl-two" class="owl-carousel owl-theme owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="owl-item">
                                <div class="card">
                                    <div class="d-flex flex-column justify-content-center align-items-center py-3">
                                        <img class="rounded-circle mb-2"
                                            src="https://i.pinimg.com/736x/cb/4d/99/cb4d9904f620667d89ed35924d99909a.jpg"
                                            alt="profile" style="width: 46px; height: 46px">
                                        <p class="fw-bold mb-0">YourName</p>
                                        <div class="d-block">
                                            @for ($x = 0; $x < 5; $x++)
                                                <i class="fas fa-star fa-sm fa-fw text-warning"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="card-body pt-2 pb-4">
                                        <p class="card-text text-center">Lorem ipsum dolor sit amet consectetur adipisicing
                                            elit. Facere, officiis in, iusto illo, neque ipsa sed quisquam laborum expedita
                                            fuga delectus et esse autem vero harum ratione suscipit voluptatibus deserunt.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="owl-nav">
                    <div class="owl-prev customPrevBtn">prev</div>
                    <div class="owl-next customNextBtn">next</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#owl-one').owlCarousel({
            // margin: 24,
            merge: true,
            autoWidth: true,
            dots: false,
            responsive: {
                0: {
                    loop: true,
                    margin: 18,
                    center: true,
                },
                768: {
                    margin: 24,
                },
            }
        });

        var owl = $('#owl-two');
        owl.owlCarousel({
            items: 1,
            loop: false,
            margin: 24,
            dots: false,
            autowidth: true,
            responsive: {
                480: {
                    items: 2
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 4,
                },

            }
        })
        $('.customNextBtn').click(function() {
            owl.trigger('next.owl.carousel');
        })
        $('.customPrevBtn').click(function() {
            owl.trigger('prev.owl.carousel', [300]);
        })
    </script>
@endsection
