@extends('pages.layouts.panel')

@section('head')
    <title>laundry aplikasi terbaik indonesia</title>
@endsection

@section('body')
    <div style="height: 15px"></div>
    <div class="py-5">
        <div class="container">
            <div class="mb-3">
                <h1 class="fst-italic">Shooping Cart</h1>
                @livewire('pages.cart')
            </div>
        </div>
    @endsection

    @section('script')
    @endsection
