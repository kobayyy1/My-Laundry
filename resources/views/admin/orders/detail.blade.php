@extends('admin.layouts.panel')

@section('head')
  <style>
    /* Minimal custom CSS untuk enhance Bootstrap classes */
    .gradient-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .btn-gradient {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      transition: all 0.3s ease;
    }
    
    .btn-gradient:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      color: white;
    }
    
    .product-image {
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
    
    .price-highlight {
      color: #28a745;
      font-weight: bold;
      font-size: 1.1rem;
    }
  </style>
@endsection

@section('body')
    <div class="container mt-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.orders') }}" class="btn btn-gradient text-white px-4 py-2 rounded-pill text-decoration-none d-inline-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Daftar Pesanan
            </a>
        </div>

        <!-- Order Header Card -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header gradient-header text-white p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2 fw-bold">
                            <i class="fas fa-receipt me-2"></i>
                            Detail Pesanan #{{ $order->orders_id }}
                        </h3>
                        <p class="mb-0 opacity-75">
                            <i class="fas fa-calendar me-2"></i>
                            {{ $order->created_at->locale('id')->translatedFormat('d F Y H:i') }} WIB
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <span class="badge bg-success fs-6 px-3 py-2 rounded-pill">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order Info -->
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="border-bottom pb-3 mb-3">
                            <strong class="text-secondary">No. Pesanan:</strong>
                            <div class="text-primary fw-bold">{{ $order->invoice }}</div>
                        </div>
                        <div class="border-bottom pb-3 mb-3">
                            <strong class="text-secondary">Tanggal Order:</strong>
                            <div>{{ $order->created_at->locale('id')->translatedFormat('d F Y H:i') }} WIB</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border-bottom pb-3 mb-3">
                            <strong class="text-secondary">Nama Customer:</strong>
                            <div class="fw-semibold">{{ $order->username }}</div>
                        </div>
                        <div class="border-bottom pb-3 mb-3">
                            <strong class="text-secondary">No. Telepon:</strong>
                            <div class="fw-semibold">{{ $order->phone }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-light border-0">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Detail Produk
                </h5>
            </div>
            <div class="card-body">
                @foreach ($order->items as $item)
                    <div class="card border rounded-3 p-3 mb-3 shadow-sm">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                @if ($item->product && $item->product->image)
                                    <img src="/images/product/{{ $item->product->image }}" alt="{{ $item->title }}"
                                        class="product-image rounded-3 border border-2 border-light">
                                @else
                                    <div class="product-image d-flex align-items-center justify-content-center bg-light rounded-3 border border-2">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="mb-2 fw-bold">{{ $item->title }}</h5>
                                        @if ($item->product)
                                            <p class="text-muted mb-2">{{ $item->product->description }}</p>
                                            <div class="d-flex align-items-center">
                                                <span class="badge {{ $item->product->status == 1 ? 'bg-success' : 'bg-secondary' }} me-2">
                                                    {{ $item->product->status == 1 ? 'Active' : 'Non Active' }}
                                                </span>
                                                <small class="text-muted">
                                                    Dibuat: {{ $item->product->created_at->format('d M Y') }}
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="mb-2">
                                            <strong class="text-secondary">Harga Satuan:</strong>
                                            <div class="price-highlight">Rp {{ number_format($item->final_price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="mb-2">
                                            <strong class="text-secondary">Berat:</strong>
                                            <div class="fw-semibold">{{ $item->qty }} KG</div>
                                        </div>
                                        <div class="mb-0">
                                            <strong class="text-secondary">Total:</strong>
                                            <div class="price-highlight fs-5">Rp {{ number_format($item->item_total, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Summary Section -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-light border-0">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-calculator me-2"></i>
                    Rincian Pembayaran
                </h5>
            </div>
            <div class="card-body">
                <div class="bg-light rounded-3 p-4">
                    <!-- Breakdown per produk -->
                    @foreach ($order->items as $item)
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <span class="fw-semibold">{{ $item->title }} ({{ $item->qty }} KG)</span>
                            </div>
                            <div class="col-md-4 text-end">
                                <span class="fw-semibold">Rp {{ number_format($item->item_total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach

                    <!-- Subtotal -->
                    <hr class="my-3">
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <strong class="fs-6">Subtotal:</strong>
                        </div>
                        <div class="col-md-4 text-end">
                            <strong class="fs-6">Rp {{ number_format($order->calculated_subtotal, 0, ',', '.') }}</strong>
                        </div>
                    </div>

                    <!-- Total Berat -->
                    <div class="row mb-2">
                        <div class="col-md-8">
                            <strong class="fs-6">Total Berat:</strong>
                        </div>
                        <div class="col-md-4 text-end">
                            <strong class="fs-6">{{ number_format($order->weight ?? $order->calculated_weight, 0, ',', '.') }} KG</strong>
                        </div>
                    </div>

                    <hr class="my-3">

                    <!-- Grand Total -->
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="mb-0 fw-bold">Total Pembayaran:</h4>
                        </div>
                        <div class="col-md-4 text-end">
                            <h4 class="mb-0">
                                <span class="price-highlight" style="font-size: 1.8rem;">
                                    Rp {{ number_format($order->grand_total ?? $order->calculated_subtotal, 0, ',', '.') }}
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Actions -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-light border-0">
                <h5 class="mb-0 fw-bold text-dark">
                    <i class="fas fa-cogs me-2"></i>
                    Admin Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Update Status:</label>
                            <select class="form-select" id="status" onchange="updateStatus({{ $order->orders_id }}, this.value)">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Quick Actions:</label>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm" onclick="printOrder({{ $order->orders_id }})">
                                    <i class="fas fa-print me-1"></i>
                                    Print Order
                                </button>
                                <button class="btn btn-success btn-sm" onclick="downloadInvoice({{ $order->orders_id }})">
                                    <i class="fas fa-download me-1"></i>
                                    Download Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateStatus(orderId, status) {
            if (confirm('Apakah Anda yakin ingin mengupdate status pesanan ini?')) {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/orders/${orderId}/status`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'status';
                statusInput.value = status;

                form.appendChild(csrfToken);
                form.appendChild(statusInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function printOrder(orderId) {
            // Open print version in new window
            window.open(`/admin/orders/${orderId}/print`, '_blank');
        }

        function downloadInvoice(orderId) {
            // Show loading indicator
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Generating PDF...';
            button.disabled = true;

            // Create download link
            const link = document.createElement('a');
            link.href = `/admin/orders/${orderId}/download`;
            link.style.display = 'none';
            document.body.appendChild(link);

            // Set timeout to reset button if download takes too long
            const timeout = setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
                alert('Download timeout. Please try again.');
                if (document.body.contains(link)) {
                    document.body.removeChild(link);
                }
            }, 30000); // 30 seconds timeout

            // Handle download
            link.addEventListener('click', () => {
                // Reset button after a short delay
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    clearTimeout(timeout);
                }, 2000);
            });

            // Trigger download
            link.click();

            // Clean up
            setTimeout(() => {
                if (document.body.contains(link)) {
                    document.body.removeChild(link);
                }
            }, 3000);
        }
    </script>
@endsection