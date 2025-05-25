@extends('admin.layouts.panel')

@section('head')
    <title>Wellcome to applikasi admin laundyku</title>
    <style>
        .img-profile{
            width: 100px;
            height: 100px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 50%;
        }
    </style>
@endsection

@section('body')
    @livewire('admin.profile.data')
    @livewire('admin.profile.password')
@endsection

@section('script')
@endsection
