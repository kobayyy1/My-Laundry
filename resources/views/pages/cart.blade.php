@extends('pages.layouts.panel')

@section('head')
    <title>laundry aplikasi terbaik indonesia</title>
@endsection

@section('body')
    <div style="height: 50px"></div>
    <div class="py-5">
        <div class="container">
            <div class="mb-3">
                <h1>Shopping Cart</h1>
                <p>Berikut detail pesenan anda</p>
            </div>
            <div class="mb-3">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Cara Memesan produk!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a
                        bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and
                        tidy.</p>
                </div>
            </div>

            @livewire('pages.cart')

        </div>
    </div>
@endsection

@section('script')
@endsection
