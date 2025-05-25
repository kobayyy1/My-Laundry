@extends('admin.layouts.panel')

@section('head')
    <title></title>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-block bg-white rounded p-3">
            <form action="{{ route('admin.orders.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="file" class="form-label">File Excel</label>
                    <input type="file" name="files" class="form-control">
                </div>
                <button class="btn btn-primary px-5" type="submit">Checkout</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
