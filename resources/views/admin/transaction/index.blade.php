@extends('admin.layouts.panel')

@section('head')
    @include('admin.layouts.style')
@endsection

@section('body')
    @livewire('admin.transaction.data')
@endsection

@section('script')
@endsection
