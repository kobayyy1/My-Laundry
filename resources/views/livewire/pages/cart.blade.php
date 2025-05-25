<div>
    <div class="row">
        @if (session('cart'))
            <div class="col-12 col-md-8">
                @foreach (session('cart') as $cart)
                    <div class="card mb-2">
                        <div class="row g-0">
                            <div class="col-md-3">
                                <img src="/images/product/{{ $cart['images'] }}" class="img-fluid rounded-start"
                                    alt="Product Image">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title mb-0">{{ $cart['title'] }}</h5>
                                    <p class="card-text">{{ $cart['description'] }}</p>
                                    @if ($cart['discount'] != null && strtotime(date('Y-m-d')) < strtotime($cart['dateDiscountEnd']))
                                        <div class="d-flex align-self-start mb-2">
                                            <h5>
                                                Rp. {{ number_format($cart['price_other'], 0, ',', '.') }}
                                            </h5>
                                            <small class="text-decoration-line-through">
                                                Rp. {{ number_format($cart['price'], 0, ',', '.') }}
                                            </small>
                                            <span class="badge rounded-pill align-self-start text-bg-primary ms-1">
                                                Diskon {{ $cart['discount'] }}%
                                            </span>
                                        </div>
                                    @else
                                        <p class="mb-0">
                                            Rp.{{ number_format($cart['price_other'], 0, ',', '.') }}
                                        </p>
                                    @endif
                                    <button wire:click="removeSession({{$cart['product_id']}})" type="button" class="btn btn-danger btn-sm position-absolute bottom-0 end-0 m-2">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-12 col-md-4">
                <div class="card p-3">
                    <h5>Summary</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>
                            Rp.
                            {{ number_format(array_sum(array_column(session('cart', []), 'price_other')), 0, ',', '.') }}
                        </span>

                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Tax</span>
                        <span>Rp. 500</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>
                            Rp.
                            {{ number_format(array_sum(array_column(session('cart', []), 'price_other')) + 500, 0, ',', '.') }}
                        </span>
                    </div>
                    <hr>
                    <button class="btn btn-success w-100">Buat Pesanan</button>
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="ratio ratio-21x9 border rounded">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <i class="fa fa-shopping-basket fa-5x" aria-hidden="true"></i>
                            <h3>Tidak Ada Product!</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
