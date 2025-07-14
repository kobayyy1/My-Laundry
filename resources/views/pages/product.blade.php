@extends('pages.layouts.panel')

@section('head')
    <title>laundryku - Product</title>
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
    <div class="pt-5 pb-4 py-md-5">
        <div class="container pt-2 pb-5">
            <div class="d-block mb-5">
                <h2 class="fw-bold mb-0">Paket Murah Laundry</h2>
                <p class="mb-0">Hemat waktu dan uang dengan paket laundry terbaik!</p>
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
                                        <a href="{{ route('product.order', ['id' => $item->product_id, 'slug' => $item->slug]) }}"
                                            class="btn btn-outline-primary btn-lg w-100 mb-4">Pilih paket</a>
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
