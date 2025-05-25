@extends('admin.layouts.panel')

@section('head')
    <title>laundryku - pembuatan product baru</title>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-block p-3 mb-3">
            <h2 class="text-them fw-bold mb-0">Create Product</h2>
            <p class="text-them-sec mb-0">Membuat product laudry baruku</p>
        </div>

        <form action="{{ route('admin.product.create.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-block rounded bg-white p-3 mb-3">
                <div class="row gx-3">
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="#" class="form-label">Nama Product</label>
                                <input type="title" name="title"
                                    class="form-control  @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback text-capitalize">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="#" class="form-label">Harga Product</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    <input type="text" name="price"
                                        class="form-control  @error('price') is-invalid @enderror">
                                </div>
                                @error('price')
                                    <span class="d-block invalid-feedback text-capitalize">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="gender" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option value="" disabled selected>Pilih status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback text-capitalize">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="#" class="form-label">Discound Harga</label>
                                <div class="input-group">
                                    <input type="text" name="discount"
                                        class="form-control  @error('discount') is-invalid @enderror">
                                    <span class="input-group-text" id="basic-addon1">.%</span>
                                </div>
                                @error('discount')
                                    <span class="d-block invalid-feedback text-capitalize">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-8">
                                <label for="#" class="form-label">Priode Discount</label>
                                <div class="d-flex gap-2">
                                    <div class="flex-fill">
                                        <input type="date" name="dateDiscountStart"
                                            class="form-control  @error('dateDiscountStart') is-invalid @enderror">
                                        @error('dateDiscountStart')
                                            <span class="invalid-feedback text-capitalize">
                                                <strong>{{ $errors->first('dateDiscountStart') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="flex-fill">
                                        <input type="date" name="dateDiscountEnd"
                                            class="form-control  @error('dateDiscountEnd') is-invalid @enderror">
                                        @error('dateDiscountEnd')
                                            <span class="invalid-feedback text-capitalize">
                                                <strong>{{ $errors->first('dateDiscountEnd') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Deskripsi Product</label>
                            <textarea name="description" id="description" rows="4"
                                class="form-control  @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <span class="invalid-feedback text-capitalize">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-lg-5">
                        @livewire('admin.product.image-upload')
                    </div>
                </div>
            </div>
            <div class="d-block rounded bg-white p-3 mb-3">
                @livewire('admin.product.product-description')
            </div>
            <div class="d-block rounded bg-white p-3 mb-3">
                <button type="submit" class="btn btn-outline-success" name="save">Save Product</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
@endsection
