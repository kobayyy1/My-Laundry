@extends('admin.layouts.panel')

@section('head')
    <title>laundryku - manage admin account</title>
    <style>
        .tb-admin-image{
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
    @livewire('admin.account.data')
@endsection

@section('script')
@endsection