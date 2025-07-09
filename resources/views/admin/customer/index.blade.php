@extends('admin.layouts.panel')

@section('head')
    <title>laundryku - Customer laundryku</title>
    <style>
        .tb-admin-image {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            overflow: hidden;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endsection

@section('body')
    @livewire('admin.customer.index')
@endsection

@section('script')
@endsection
