@extends('admin.layouts.panel')

@section('head')
    <title>laundryku - Data product laundryku</title>
    <style>
        .product-card-image{
            width: 100px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('body')
    @livewire('admin.product.data')
@endsection

@section('script')
@endsection
