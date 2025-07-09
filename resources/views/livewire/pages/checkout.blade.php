<div>
    <div class="row">
        @if (!empty($selectedItems) && count($selectedItems) > 0)
            <div class="col-12 col-md-8">
                @foreach ($selectedCartItems as $cart)
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

                                    @if ($cart['discount'] && strtotime(date('Y-m-d')) < strtotime($cart['dateDiscountEnd']))
                                        <div class="d-flex align-self-start mb-2">
                                            <h5>Rp. {{ number_format($cart['price_other'], 0, ',', '.') }}</h5>
                                            <small class="text-decoration-line-through ms-2">
                                                Rp. {{ number_format($cart['price'], 0, ',', '.') }}
                                            </small>
                                            <span class="badge rounded-pill text-bg-primary ms-2">
                                                Diskon {{ $cart['discount'] }}%
                                            </span>
                                        </div>
                                    @else
                                        <p class="mb-0">Rp.{{ number_format($cart['price'], 0, ',', '.') }}</p>
                                    @endif
                                    <button wire:click="removeSession({{ $cart['product_id'] }})" type="button"
                                        class="btn btn-danger btn-sm position-absolute bottom-0 end-0 m-2">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Ringkasan Pembayaran --}}
            <div class="col-12 col-md-4">
                <div class="card p-3">
                    <h5>Ringkasan</h5>
                    <hr>

                    @php
                        $priceperkg = 0;
                        foreach ($selectedCartItems as $item) {
                            $price = $item['discount'] > 0 ? $item['price_other'] : $item['price'];
                            $priceperkg += $price * $item['qty'];
                        }
                    @endphp

                    <div class="d-flex justify-content-between">
                        <span>Harga Total (per KG)</span>
                        <span>Rp. {{ number_format($priceperkg, 0, ',', '.') }}</span>
                    </div>

                    <div class="alert alert-warning mt-3">
                        <small><i class="fa fa-info-circle"></i> Total berat, total, dan grand total akan dihitung dan
                            dikonfirmasi oleh admin setelah pesanan dibuat.</small>
                    </div>

                    <hr>

                    <button wire:click="placeOrder" class="btn btn-success w-100">
                        Buat Pesanan
                    </button>
                </div>
            </div>
        @else
            {{-- Jika tidak ada produk yang dipilih --}}
            <div class="col-12">
                <div class="ratio ratio-21x9 border rounded">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <i class="fa fa-shopping-basket fa-5x" aria-hidden="true"></i>
                            <h3>Tidak Ada Produk yang Dipilih!</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
