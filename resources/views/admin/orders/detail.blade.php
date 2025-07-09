@extends('admin.layouts.panel')

@section('head')
  <style>
      .order-card {
          border: none;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
          border-radius: 12px;
          overflow: hidden;
      }

      .order-header {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          color: white;
          padding: 1.5rem;
      }

      .status-badge {
          padding: 0.5rem 1rem;
          border-radius: 20px;
          font-size: 0.9rem;
          font-weight: 600;
      }

      .product-image {
          width: 100px;
          height: 100px;
          object-fit: cover;
          border-radius: 10px;
          border: 3px solid #f8f9fa;
      }

      .product-card {
          background: #fff;
          border: 1px solid #e9ecef;
          border-radius: 10px;
          padding: 1.5rem;
          margin-bottom: 1rem;
          transition: transform 0.2s ease;
      }

      .product-card:hover {
          transform: translateY(-2px);
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      }

      .info-row {
          padding: 0.75rem 0;
          border-bottom: 1px solid #f1f1f1;
      }

      .info-row:last-child {
          border-bottom: none;
      }

      .price-highlight {
          color: #28a745;
          font-weight: bold;
          font-size: 1.1rem;
      }

      .total-section {
          background: #f8f9fa;
          border-radius: 10px;
          padding: 1.5rem;
          margin-top: 2rem;
      }

      .btn-back {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          border: none;
          color: white;
          padding: 0.75rem 1.5rem;
          border-radius: 8px;
          text-decoration: none;
          display: inline-flex;
          align-items: center;
          transition: all 0.3s ease;
      }

      .btn-back:hover {
          transform: translateY(-2px);
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
          color: white;
      }
  </style>
@endsection

@section('body')
    <div class="container mt-4">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.orders') }}" class="btn-back">
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
                            {{ ucfirst($order->status) }}
                        </span>
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

        <!-- Admin Actions -->
        <div class="card order-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-cogs me-2"></i>
                    Admin Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Update Status:</label>
                            <select class="form-control" id="status"
                                onchange="updateStatus({{ $order->orders_id }}, this.value)">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped
                                </option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered
                                </option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quick Actions:</label><br>
                            <button class="btn btn-primary btn-sm me-2" onclick="printOrder({{ $order->orders_id }})">
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

    <!-- Bagian akhir dari view file Anda, ganti script yang sudah ada -->
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
