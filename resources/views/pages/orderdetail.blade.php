@extends('pages.layouts.panel')

@section('head')
@endsection

@section('body')
    <div class="container mt-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('user.order') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Daftar Pesanan
            </a>
        </div>

        <!-- Order Header Card -->
        <div class="order-card mb-4">
            <div class="order-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2">
                            <i class="fas fa-receipt me-2"></i>
                            Detail Pesanan #{{ $order->orders_id }}
                        </h3>
                        <p class="mb-0 opacity-75">
                            <i class="fas fa-calendar me-2"></i>
                            {{ $order->created_at->locale('id')->translatedFormat('d F Y H:i') }} WIB
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="status-badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ ucfirst($order->status) }} </span>
                    </div>
                </div>
            </div>

            <!-- Order Info -->
            <div class="p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row">
                            <strong>No. Pesanan:</strong>
                            <span class="text-primary">{{ $order->invoice }}</span>
                        </div>
                        <div class="info-row">
                            <strong>Tanggal Order:</strong>
                            {{ $order->created_at->locale('id')->translatedFormat('d F Y H:i') }} WIB
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row">
                            <strong>Nama Customer:</strong>
                            {{ $order->username }}
                        </div>
                        <div class="info-row">
                            <strong>No. Telepon:</strong>
                            {{ $order->phone }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="card order-card mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Detail Produk
                </h5>
            </div>
            <div class="card-body">
                @foreach ($order->items as $item)
                    <div class="product-card">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                @if ($item->product && $item->product->image)
                                    <img src="/images/product/{{ $item->product->image }}" alt="{{ $item->title }}"
                                        class="product-image">
                                @else
                                    <div class="product-image d-flex align-items-center justify-content-center bg-light">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="mb-2">{{ $item->title }}</h5>
                                        @if ($item->product)
                                            <p class="text-muted mb-2">{{ $item->product->description }}</p>
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="badge {{ $item->product->status == 1 ? 'bg-success' : 'bg-secondary' }} me-2">
                                                    {{ $item->product->status == 1 ? 'Active' : 'Non Active' }}
                                                </span>
                                                <small class="text-muted">
                                                    Dibuat: {{ $item->product->created_at->format('d M Y') }}
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <p class="mb-1">
                                            <strong>Harga Satuan:</strong><br>
                                            <span class="price-highlight">Rp
                                                {{ number_format($item->final_price, 0, ',', '.') }}</span>
                                        </p>
                                        <p class="mb-1">
                                            <strong>Berat:</strong> {{ $item->qty }} KG
                                        </p>
                                        <p class="mb-0">
                                            <strong>Total:</strong><br>
                                            <span class="price-highlight">Rp
                                                {{ number_format($item->item_total, 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Summary Section -->
        <div class="card order-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-calculator me-2"></i>
                    Rincian Pembayaran
                </h5>
            </div>
            <div class="card-body">
                <div class="total-section">
                    <!-- Breakdown per produk -->
                    @foreach ($order->items as $item)
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <span>{{ $item->title }} ({{ $item->qty }} KG)</span>
                            </div>
                            <div class="col-md-4 text-end">
                                <span>Rp {{ number_format($item->item_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach

                    <!-- Subtotal -->
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <strong>Subtotal:</strong>
                        </div>
                        <div class="col-md-4 text-end">
                            <strong>Rp {{ number_format($order->calculated_subtotal, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <!-- Total Berat -->
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <strong>Total Berat:</strong>
                        </div>
                        <div class="col-md-4 text-end">
                            <strong>{{ number_format($order->weight ?? $order->calculated_weight, 0, ',', '.') }}
                                KG</strong>
                        </div>
                    </div>

                    <hr>

                    <!-- Grand Total -->
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="mb-0">
                                <strong>Total Pembayaran:</strong>
                            </h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <h4 class="mb-0">
                                <span class="price-highlight" style="font-size: 1.5rem;">
                                    Rp {{ number_format($order->grand_total ?? $order->calculated_subtotal, 0, ',', '.') }}
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
