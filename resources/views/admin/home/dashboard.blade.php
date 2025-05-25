@extends('admin.layouts.panel')

@section('head')
    <title>Wellcome to applikasi admin laundyku</title>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-block p-3 mb-2">
            <h2 class="text-them fw-bold mb-0">LaundryKu</h2>
            <p class="text-them-sec mb-0">Selamat datang kembali di aplikasi laundryku</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-money-bill fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">10000</p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Transaction</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-users fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">10000</p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Costumer</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-box fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">{{$product}}</p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Product</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-plane fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">10000</p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Plane</p>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
@endsection