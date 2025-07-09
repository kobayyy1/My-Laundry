@extends('pages.layouts.panel')

@section('head')
    <title>Profile</title>
@endsection

@section('body')
    <div class="pt-5 pb-5">
        <div class="container pt-5 pb-5">
            <h2 class="fw-bold text-primary mb-4">Profil Saya</h2>
            <div class="row">
                <!-- Kolom Avatar -->
                <div class="col-12 col-md-4 text-center mb-4">
                    <img src="/images/avatar/{{ $user->avatar }}"
                        class="img-fluid rounded-circle shadow mb-3"
                        style="width: 180px; height: 180px; object-fit: cover;">
                </div>

                <!-- Kolom Informasi Profil -->
                <div class="col-12 col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <p class="form-control-plaintext">{{ $user->username }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <p class="form-control-plaintext">
                            {{ $user->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <p class="form-control-plaintext">{{ $user->born }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <p class="form-control-plaintext">{{ $user->phone }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <p class="form-control-plaintext">{{ $user->country }}</p>
                    </div>

                    <a href="{{ route('profile.update') }}" class="btn btn-primary mt-3 px-4">Edit Profile</a>
                    <a href="{{ route('index') }}" class="btn btn-danger mt-3 px-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
