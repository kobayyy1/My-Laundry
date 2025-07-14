@extends('pages.layouts.panel')

@section('head')
    <title>laundryku - About Me Pages</title>
@endsection

@section('body')
    <div class="container py-5">
        <h2 class="fw-bold text-primary mb-4">Tentang Kami</h2>
        <p class="fs-5 text-secondary">
            Kami adalah penyedia layanan laundry profesional yang berkomitmen memberikan hasil terbaik
            untuk setiap cucian Anda. Dengan teknologi modern dan tenaga kerja terlatih, kami menjamin
            kebersihan dan ketepatan waktu.
        </p>
        <img src="{{ asset('images/content/laundry-team.jpg') }}" class="img-fluid rounded shadow mt-4" alt="Tim Laundry">
    </div>
@endsection


@section('script')
@endsection
