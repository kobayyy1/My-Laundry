<div>
    <div class="row">
        @if (session('cart'))
            <div class="col-12 col-md-8">
                @foreach (session('cart') as $cart)
                    <div class="card mb-2" wire:key="cart-item-{{ $cart['product_id'] }}">
                        <div class="row g-0">
                            <div class="col-md-3 position-relative">
                                <input type="checkbox" wire:model="selectedItems" value="{{ $cart['product_id'] }}"
                                    class="form-check-input position-absolute top-0 start-0 m-2"
                                    style="transform: scale(1.4); z-index: 2;">
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
                                            <span class="badge text-bg-primary ms-2">
                                                Diskon {{ $cart['discount'] }}%
                                            </span>
                                        </div>
                                    @else
                                        <p class="mb-0">Rp.{{ number_format($cart['price_other'], 0, ',', '.') }}</p>
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
            <div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <button wire:click="goToCheckout" class="btn btn-success w-100">
                    Process To Checkout
                </button>
            </div>
        @else
            <div class="col-12">
                <div class="ratio ratio-21x9 border rounded">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <i class="fa fa-shopping-basket fa-5x" aria-hidden="true"></i>
                            <h3>Tidak Ada Produk!</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
