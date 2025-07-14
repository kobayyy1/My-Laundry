@extends('pages.layouts.panel')

@section('head')
    <title>Laundryku - Aplikasi Laundry Terbaik Indonesia</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --light-bg: #f8fafc;
            --dark-text: #1e293b;
            --gray-text: #64748b;
            --success-color: #10b981;
            --gradient-primary: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            --gradient-secondary: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        }

        .banner1 {
            background-image: url('/images/banner/banner2.png');
            background-position: top;
            background-size: cover;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .banner1 h1 {
            font-weight: 700;
        }

        .banner1 p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: white;
            background: var(--secondary-color);
        }

        .product-card {
            width: 25rem;
            overflow: hidden;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .product-card-image {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 12px 12px 0 0;
        }

        .card-price {
            color: var(--primary-color);
        }

        .badge-discount {
            background: var(--gradient-primary) !important;
            color: white;
            border-radius: 20px;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .btn-outline-primary-custom {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
            font-weight: 600;
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-outline-primary-custom:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .section-cta {
            background: var(--gradient-secondary);
            position: relative;
            overflow: hidden;
        }

        .section-cta::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            z-index: 1;
        }

        .section-cta .container {
            position: relative;
            z-index: 2;
        }

        .section-cta h1 {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-cta p {
            color: var(--gray-text);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .why-choose-section {
            padding: 5rem 0;
            background: white;
        }

        .why-choose-section h1 {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .why-choose-section p {
            color: var(--gray-text);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .partner-section {
            background: var(--light-bg);
            position: relative;
        }

        .partner-card {
            background: white;
            border: none;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            color: var(--dark-text);
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .partner-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .testimonial-section {
            padding: 5rem 0;
            background: white;
        }

        .testimonial-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: white;
        }

        .testimonial-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .star-rating {
            color: #fbbf24;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
        }

        .feature-list .check-icon {
            color: var(--success-color);
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-title p {
            color: var(--gray-text);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .custom-nav-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .custom-nav-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .image-container {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media(max-width: 576px) {
            .product-card {
                width: 21rem;
            }

            .banner1 {
                min-height: 60vh;
                text-align: center;
            }

            .banner1 h1 {
                font-size: 2rem;
            }

            .why-choose-section {
                text-align: center;
            }
        }
    </style>
@endsection

@section('body')
    <!-- Hero Banner -->
    <section class="banner1">
        <div class="container">
            <div class="row gy-5 gy-md-0 justify-content-between align-items-center">
                <div class="col-12 col-md-6 order-2 order-md-1">
                    <h1 class="display-4 fw-bold mb-4">Dapatkan Layanan Laundry Terbaik Sekarang Juga</h1>
                    <p class="mb-4">"Layanan laundry profesional dengan kualitas premium - cepat, bersih, wangi, dan tepat
                        waktu. Solusi praktis untuk pakaian Anda, kapan saja dan di mana saja."</p>
                    <a href="{{ route('signup') }}" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-rocket me-2"></i>Daftar Sekarang
                    </a>
                </div>
                <div class="col-12 col-md-5 order-1 order-md-2">
                    <div class="image-container">
                        <img src="{{ url('/images/banner/laundrybanner1.png') }}" alt="Laundry Banner" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-5 bg-light">
        <div class="container pt-4 pb-5">
            <div class="section-title">
                <h2 class="fw-bold">Paket Laundry Premium</h2>
                <p>Pilih paket laundry yang sesuai dengan kebutuhan Anda. Semua paket hadir dengan kualitas terbaik dan
                    harga yang bersahabat.</p>
            </div>

            <div id="owl-one" class="owl-carousel owl-theme owl-loaded">
                <div class="owl-stage-outer">
                    <div class="owl-stage d-flex">
                        @foreach ($product as $index => $item)
                            <div class="owl-item d-flex align-self-stretch">
                                <div class="card product-card">
                                    <div class="product-card-image ratio ratio-4x3"
                                        style="background-image: url('/images/product/{{ $item->image }}')"></div>
                                    <div class="card-body py-4">
                                        <div class="card-titles mb-3">
                                            <h5 class="mb-2 fw-bold text-dark">{{ $item->title }}</h5>
                                            <p class="mb-0 text-muted">{{ $item->description }}</p>
                                        </div>
                                        <div class="card-price mb-3">
                                            @if ($item->discount != null && strtotime(date('Y-m-d')) < strtotime($item->dateDiscountEnd))
                                                <div class="mb-2">
                                                    <span class="text-decoration-line-through text-muted">Rp.
                                                        {{ number_format($item->price) }}</span>
                                                    <span class="badge badge-discount ms-2">
                                                        <i class="fas fa-tags me-1"></i>Diskon {{ $item->discount }}%
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-end">
                                                    <span class="fs-5 mb-1">Rp.</span>
                                                    <span
                                                        class="fw-bold fs-2 text-primary">{{ number_format($item->price_other) }}</span>
                                                    <span class="fs-5 mb-1 text-muted">/Kg</span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-end" style="padding-top: 2rem">
                                                    <span class="fs-5 mb-1">Rp.</span>
                                                    <span
                                                        class="fw-bold fs-2 text-primary">{{ number_format($item->price_other) }}</span>
                                                    <span class="fs-5 mb-1 text-muted">/Kg</span>
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('product.order', ['id' => $item->product_id, 'slug' => $item->slug]) }}"
                                            class="btn btn-outline-primary-custom w-100 mb-4">
                                            <i class="fas fa-shopping-cart me-2"></i>Pilih Paket
                                        </a>
                                        <hr class="my-3">
                                        <ul class="feature-list">
                                            @foreach ($item->descriptionList as $items)
                                                <li>
                                                    <i class="fas fa-check-circle check-icon"></i>
                                                    <span>{{ $items }}</span>
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
    </section>

    <!-- Call to Action -->
    <section class="section-cta py-5">
        <div class="container">
            <div class="text-center py-4">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="fas fa-star text-warning me-2"></i>
                    Bergabunglah dengan Laundryku
                </h1>
                <p class="lead">Rasakan pengalaman laundry yang berbeda dengan layanan profesional, cepat, dan berkualitas
                    tinggi. Kepuasan pelanggan adalah prioritas utama kami.</p>
                <a href="{{ route('signup') }}" class="btn btn-primary-custom btn-lg px-5">
                    <i class="fas fa-user-plus me-2"></i>DAFTAR SEKARANG
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-section">
        <div class="container">
            <div class="row g-5 align-items-center justify-content-center mb-5">
                <div class="col-12 col-lg-6 order-2">
                    <div class="text-center text-lg-start">
                        <h1 class="display-6 fw-bold mb-3">
                            <i class="fas fa-award text-primary me-2"></i>
                            Mengapa Memilih Laundryku?
                        </h1>
                        <p class="lead">"Laundryku hadir sebagai solusi terpercaya untuk kebutuhan laundry Anda. Dengan
                            teknologi modern, deterjen premium, dan tim berpengalaman, kami memberikan hasil terbaik untuk
                            setiap pakaian. Harga terjangkau, kualitas premium, dan kepuasan pelanggan adalah komitmen
                            kami."</p>
                        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start mt-4">
                            <div class="badge bg-primary fs-6 py-2 px-3">
                                <i class="fas fa-clock me-2"></i>Cepat
                            </div>
                            <div class="badge bg-success fs-6 py-2 px-3">
                                <i class="fas fa-leaf me-2"></i>Ramah Lingkungan
                            </div>
                            <div class="badge bg-info fs-6 py-2 px-3">
                                <i class="fas fa-shield-alt me-2"></i>Terpercaya
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-1 order-lg-2">
                    <div class="image-container">
                        <img src="{{ url('/images/content/Laundry3.jpeg') }}" alt="Laundry Professional" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="image-container">
                        <img src="{{ url('/images/content/Laundry4.jpg') }}" alt="Fabric Care" class="img-fluid">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="text-center text-lg-start">
                        <h1 class="display-6 fw-bold mb-3">
                            <i class="fas fa-tshirt text-primary me-2"></i>
                            Perawatan Khusus Setiap Jenis Kain
                        </h1>
                        <p class="lead">"Setiap jenis kain memerlukan perawatan yang berbeda. Tim ahli kami memahami
                            karakteristik berbagai material - dari katun hingga sutra, dari denim hingga bahan sintetis.
                            Dengan pengetahuan mendalam dan peralatan modern, kami pastikan setiap pakaian mendapat
                            perlakuan yang tepat."</p>
                        <div class="row g-3 mt-3">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small class="fw-medium">Analisis Jenis Kain</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small class="fw-medium">Deterjen Khusus</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small class="fw-medium">Suhu Optimal</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <small class="fw-medium">Pengeringan Aman</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Features Section (Replace Partners) -->
    <section class="service-features-section py-5 bg-light">
        <div class="container pb-3">
            <div class="section-title">
                <h2 class="fw-bold">
                    <i class="fas fa-star text-primary me-2"></i>
                    Keunggulan Layanan Kami
                </h2>
                <p>Mengapa ribuan pelanggan mempercayai Laundryku untuk kebutuhan laundry mereka setiap hari.</p>
            </div>
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="partner-card">
                        <i class="fas fa-shield-alt text-primary mb-2 fs-4"></i>
                        <div class="fw-bold">Garansi Kualitas</div>
                        <small class="text-muted">Jaminan kepuasan 100% atau uang kembali</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="partner-card">
                        <i class="fas fa-leaf text-primary mb-2 fs-4"></i>
                        <div class="fw-bold">Ramah Lingkungan</div>
                        <small class="text-muted">Deterjen eco-friendly dan proses hemat air</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="partner-card">
                        <i class="fas fa-mobile-alt text-primary mb-2 fs-4"></i>
                        <div class="fw-bold">Aplikasi Mobile</div>
                        <small class="text-muted">Pesan dan tracking mudah via smartphone</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="partner-card">
                        <i class="fas fa-award text-primary mb-2 fs-4"></i>
                        <div class="fw-bold">Teknologi Modern</div>
                        <small class="text-muted">Mesin cuci premium dan teknik terdepan</small>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="partner-card">
                        <i class="fas fa-users text-primary mb-2 fs-4"></i>
                        <div class="fw-bold">Tim Profesional</div>
                        <small class="text-muted">Staff berpengalaman dan terlatih</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps Section (Replace Testimonials) -->
    <section class="process-section py-5">
        <div class="container py-4">
            <div class="section-title">
                <h2 class="fw-bold">
                    <i class="fas fa-cogs text-primary me-2"></i>
                    Cara Kerja Laundryku
                </h2>
                <p>Proses laundry yang mudah dan praktis dalam 4 langkah sederhana.</p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <span class="fw-bold fs-5">1</span>
                                </div>
                                <h5 class="fw-bold mb-2">Pesan Online</h5>
                            </div>
                            <p class="card-text">Pesan layanan laundry melalui website atau aplikasi mobile kami. Pilih
                                paket yang sesuai kebutuhan Anda.</p>
                            <div class="mt-3">
                                <i class="fas fa-mobile-alt text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <div class="bg-success text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <span class="fw-bold fs-5">2</span>
                                </div>
                                <h5 class="fw-bold mb-2">Menuju toko Laundry</h5>
                            </div>
                            <p class="card-text">Tim kami akan memproses sesuai layanan yang anda pilih ,datang ke lokasi
                                yang sudah tertera untuk melanjutkan proses.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <div class="bg-info text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <span class="fw-bold fs-5">3</span>
                                </div>
                                <h5 class="fw-bold mb-2">Proses Laundry</h5>
                            </div>
                            <p class="card-text">Pakaian Anda akan diproses dengan teknologi modern dan deterjen
                                berkualitas tinggi oleh tim profesional.</p>
                            <div class="mt-3">
                                <i class="fas fa-tshirt text-info fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card testimonial-card h-100">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <div class="bg-warning text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <span class="fw-bold fs-5">4</span>
                                </div>
                                <h5 class="fw-bold mb-2">Pengantaran</h5>
                            </div>
                            <p class="card-text">Pakaian bersih dan wangi akan diantarkan kembali ke alamat Anda dalam
                                kondisi rapi dan siap pakai.</p>
                            <div class="mt-3">
                                <i class="fas fa-home text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('signup') }}" class="btn btn-primary-custom btn-lg px-5">
                    <i class="fas fa-play me-2"></i>Mulai Sekarang
                </a>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#owl-one').owlCarousel({
                merge: true,
                autoWidth: true,
                dots: false,
                nav: false,
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
                loop: true,
                margin: 24,
                dots: false,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    480: {
                        items: 1
                    },
                    768: {
                        items: 2,
                    },
                    992: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    }
                }
            });

            $('.customNextBtn').click(function() {
                owl.trigger('next.owl.carousel');
            });

            $('.customPrevBtn').click(function() {
                owl.trigger('prev.owl.carousel', [300]);
            });
        });
    </script>
@endsection
