@extends('pages.layouts.panel')

@section('head')
    <title>laundry aplikasi terbaik indonesia</title>
@endsection
@section('body')
    <div style="height: 50px"></div>
    <div class="py-5">
        <div class="container">
            <div class="mb-3">
                <h1>Proses To Checkout</h1>
                <p>Berikut detail pesenan anda</p>
            </div>
            <div class="mb-3">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Cara Memesan produk!</h4>
                    <p>Berikut adalah versi kalimat dengan panjang kata serupa dan nada yang sepadan, tetapi menjelaskan
                        instruksi pemesanan:
                        > Aww yeah, kamu berhasil menyelesaikan proses checkout. Sekarang silakan pergi ke toko laundry
                        terdekat untuk menyelesaikan pemesanan dan menyerahkan cucian kamu secara langsung di sana.
                    </p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and
                        tidy.</p>
                </div>
            </div>
            @livewire('pages.checkout')
        @endsection

        @section('script')
        @endsection
