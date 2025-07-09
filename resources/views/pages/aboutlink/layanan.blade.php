@extends('pages.layouts.panel')

@section('head')
    <title>laundryku - About Me Pages</title>
@endsection

<div class="container py-5">
    <h2 class="fw-bold text-primary mb-4">Layanan Kami</h2>
    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-start">
            <i class="fas fa-tshirt fa-2x text-primary me-3"></i>
            <div>
                <h5 class="fw-semibold">Cuci Kiloan</h5>
                <p class="text-secondary mb-0">Layanan cuci pakaian dengan tarif per kilogram, efisien dan hemat.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-start">
            <i class="fas fa-user-astronaut fa-2x text-primary me-3"></i>
            <div>
                <h5 class="fw-semibold">Setrika Saja</h5>
                <p class="text-secondary mb-0">Hanya setrika pakaian Anda agar selalu rapi dan terlihat baru.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-start">
            <i class="fas fa-hand-sparkles fa-2x text-primary me-3"></i>
            <div>
                <h5 class="fw-semibold">Cuci dan Setrika</h5>
                <p class="text-secondary mb-0">Layanan lengkap untuk mencuci dan menyetrika pakaian Anda.</p>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 d-flex align-items-start">
            <i class="fas fa-bolt fa-2x text-primary me-3"></i>
            <div>
                <h5 class="fw-semibold">Layanan Express</h5>
                <p class="text-secondary mb-0">Pakaian selesai dalam 1 hari, cocok untuk kebutuhan mendesak.</p>
            </div>
        </div>
    </div>
</div>


@section('script')
@endsection
