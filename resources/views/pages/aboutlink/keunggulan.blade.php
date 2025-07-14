@extends('pages.layouts.panel')

@section('head')
    <title>laundryku - About Me Pages</title>
@endsection

@section('body')
    <div class="container py-5">
        <h2 class="fw-bold text-primary mb-4">Keunggulan Kami</h2>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <i class="fas fa-tshirt fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Kualitas Terjamin</h5>
                <p class="text-secondary">Kami menggunakan detergen ramah lingkungan dan mesin modern.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Tepat Waktu</h5>
                <p class="text-secondary">Proses cepat dengan layanan express sesuai kebutuhan Anda.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="fas fa-user-check fa-3x text-primary mb-3"></i>
                <h5 class="fw-bold">Pelayanan Ramah</h5>
                <p class="text-secondary">Staff kami siap membantu Anda dengan profesional dan sopan.</p>
            </div>
        </div>
    </div>
@endsection



@section('script')
@endsection
