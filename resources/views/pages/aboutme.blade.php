@extends('pages.layouts.panel')

@section('head')
@endsection

@section('body')
    <div class="pt-5 pb-4 bg-light">
        <div class="container pt-5 pb-5">
            <div class="row g-4 mb-5 align-items-start">
                <div class="col-12 col-md-7">
                    <div class="me-0 me-md-5">
                        <h4 class="fw-bold mb-3">
                            <i class="fas fa-user-circle me-2 text-primary"></i>About Me
                        </h4>
                        <p class="text-muted">
                            <i class="fas fa-hands-helping me-2 text-success"></i>
                            Selamat datang di layanan laundry kami! Kami hadir untuk memberikan solusi praktis dan efisien
                            bagi Anda yang menginginkan pakaian bersih tanpa repot. Komitmen kami adalah memberikan layanan
                            yang cepat, tepat waktu, dan hasil cucian yang rapi serta wangi.
                        </p>
                        <p class="text-muted">
                            <i class="fas fa-tshirt me-2 text-info"></i>
                            Didukung oleh tenaga profesional berpengalaman dan peralatan laundry modern, kami memastikan
                            setiap jenis pakaian – dari kaus harian hingga pakaian formal – ditangani dengan standar
                            kebersihan dan kehati-hatian tertinggi.
                        </p>
                        <p class="text-muted">
                            <i class="fas fa-smile me-2 text-warning"></i>
                            Kepuasan pelanggan adalah prioritas utama kami. Kami menyediakan berbagai pilihan layanan, mulai
                            dari cuci lipat reguler, dry clean, hingga layanan express. Kami juga mendengarkan feedback
                            untuk terus meningkatkan kualitas pelayanan kami.
                        </p>
                        <p class="text-muted">
                            <i class="fas fa-heart me-2 text-danger"></i>
                            Terima kasih telah mempercayakan kebutuhan laundry Anda kepada kami. Kami siap menjadi mitra
                            andalan Anda dalam menjaga penampilan yang bersih dan percaya diri, kapan saja dan di mana saja.
                        </p>

                    </div>
                </div>

                <!-- Kolom Kanan (Navigasi) -->
                <div class="col-12 col-md-5">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <ul class="nav flex-column">
                                <a class="nav-link link-secondary px-0 link-light" href="{{ route('tentang') }}">Tentang
                                    Kami</a>
                                <a class="nav-link link-secondary px-0 link-light" href="{{ route('layanan') }}">Layanan
                                    Kami</a>
                                <a class="nav-link link-secondary px-0 link-light" href="{{ route('carakerja') }}">Cara
                                    Pemesanan</a>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="nav flex-column">
                                <a class="nav-link link-secondary px-0 link-light" href="{{ route('kontak') }}">Kontak
                                    Kami</a>
                                <a class="nav-link link-secondary px-0 link-light"
                                    href="{{ route('keunggulan') }}">Keunggulan Kami</a>
                                <a class="nav-link link-secondary px-0 link-light" href="{{ route('faq') }}">FAQ</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
