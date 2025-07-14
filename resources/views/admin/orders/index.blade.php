@extends('admin.layouts.panel')
@section('head')
    @include('admin.layouts.style')
@endsection
@section('body')
    @livewire('admin.order.data')
@endsection
