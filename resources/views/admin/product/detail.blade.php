@extends('admin.layouts.panel')

@section('head')
    <title>laundryku - detail produk</title>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-block p-3 mb-3">
            <h2 class="text-them fw-bold mb-0">Detail Product</h2>
            <p class="text-them-sec mb-0">Lihat detail produk laundry baruku</p>
        </div>

        <div class="d-block rounded bg-white p-3 mb-3">
            <div class="row gx-3">
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Nama Produk</label>
                            <p class="form-control bg-light">{{ $data->title }}</p>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label fw-bold">Harga Produk</label>
                            <p class="form-control bg-light">Rp. {{ number_format($data->price, 0, ',', '.') }}</p>
                        </div>

                        <div class="col-12 col-lg-6">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control bg-light">
                                @if($data->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Non Active</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-12 col-lg-4">
                            <label class="form-label fw-bold">Diskon</label>
                            <p class="form-control bg-light">{{ $data->discount }}%</p>
                        </div>

                        <div class="col-12 col-lg-8">
                            <label class="form-label fw-bold">Periode Diskon</label>
                            @if($data->dateDiscountStart && $data->dateDiscountEnd)
                                <p class="form-control bg-light">
                                    {{ \Carbon\Carbon::parse($data->dateDiscountStart)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($data->dateDiscountEnd)->format('d M Y') }}
                                </p>
                            @else
                                <p class="form-control bg-light text-muted">Tidak ada periode diskon</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Produk</label>
                        <div class="border rounded bg-light p-2">{!! $data->description !!}</div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-5">
                    @livewire('admin.product.image-upload', ['post'=> $data->image])
                </div>
            </div>
        </div>


        @if($status = 'onpayment-waiting')
        <div>
            alert (redy pickup laundry)
            anda belum membayar sisa tagihan sebesar
            (grand_total - totalbayar)
        </div>
        @endif

        <div class="d-block rounded bg-white p-3 mb-3">
            @livewire('admin.product.product-description', ['post' => $data->descriptionList])
        </div>

        <div class="d-block rounded bg-white p-3 mb-3">
            <a href="{{ route('admin.product.update', ['id' => $data->product_id]) }}" class="btn btn-outline-primary">Edit Product</a>
            <a href="{{ route('admin.product') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
    </div>
@endsection

@section('script')
@endsection
