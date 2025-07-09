@extends('admin.layouts.panel')

@section('head')
    <title>Welcome to Admin Laundryku</title>
    <style>
        .img-profile {
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
    <div class="container-fluid mb-3">
        <div class="d-block bg-white rounded-3 border shadow-sm">
            <div class="d-flex align-items-center py-2 px-3 border-bottom">
                <p class="mb-0 fw-bold text-color">Customer Detail</p>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="{{ $data->username }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" value="{{ $data->email }}" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="btn border border-right-0" id="basic-addon1">+62</span>
                                <input type="text" id="phone" class="form-control" placeholder="phone"
                                    value="{{ $data->phone }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="born" class="form-label">Born</label>
                            <input type="date" id="born" class="form-control" value="{{ $data->born }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea name="address" id="address" class="form-control" rows="3" disabled>{{ $data->country }}</textarea>
                </div>
                <a href="{{ route('admin.customer',['id' => $data->user_id])}}" class="btn btn-outline-danger">Kembali</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
