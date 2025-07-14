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

        .form-floating-custom {
            position: relative;
        }

        .form-floating-custom .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-floating-custom .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .readonly-field {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }

        .price-display {
            color: #28a745;
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
@endsection

@section('body')
    <div class="container mt-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header gradient-header text-white">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-edit me-3 fs-4"></i>
                            <div>
                                <h4 class="mb-1 fw-bold">Edit Pesanan</h4>
                                <p class="mb-0 opacity-75">Order ID: #{{ $order->orders_id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-light border-0">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-form me-2"></i>
                            Detail Pesanan
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.orders.update.post', $order->orders_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Customer Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-secondary mb-3">
                                    <i class="fas fa-user me-2"></i>
                                    Informasi Pelanggan
                                </h6>
                                <div class="form-floating-custom">
                                    <label for="username" class="form-label fw-semibold">Nama Pelanggan</label>
                                    <input type="text" class="form-control form-control-lg readonly-field" id="username"
                                        value="{{ $order->username }}" readonly>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Data pelanggan tidak dapat diubah
                                    </small>
                                </div>
                            </div>

                            <!-- Price Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-secondary mb-3">
                                    <i class="fas fa-dollar-sign me-2"></i>
                                    Informasi Harga
                                </h6>
                                <div class="form-floating-custom">
                                    <label for="price" class="form-label fw-semibold">Harga Per Kg</label>
                                    <input type="text" class="form-control form-control-lg readonly-field price-display"
                                        id="price" value="Rp. {{ number_format($order->price, 0, ',', '.') }}" readonly>
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Harga dasar per kilogram
                                    </small>
                                </div>
                            </div>

                            <!-- Weight Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-secondary mb-3">
                                    <i class="fas fa-weight me-2"></i>
                                    Berat Pesanan
                                </h6>
                                <div class="form-floating-custom">
                                    <label for="weight" class="form-label fw-semibold">Berat (KG) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="weight"
                                        class="form-control form-control-lg @error('weight') is-invalid @enderror"
                                        id="weight" value="{{ old('weight', $order->weight) }}"
                                        placeholder="Masukkan berat dalam kilogram" min="0" step="0.1">
                                    @error('weight')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Berat akan mempengaruhi total harga pesanan
                                    </small>
                                </div>
                            </div>

                            <!-- Status Information -->
                            <div class="mb-4">
                                <h6 class="fw-bold text-secondary mb-3">
                                    <i class="fas fa-tasks me-2"></i>
                                    Status Pesanan
                                </h6>
                                <div class="form-floating-custom">
                                    <label for="status" class="form-label fw-semibold">Status <span
                                            class="text-danger">*</span></label>
                                    <select name="status"
                                        class="form-select form-select-lg @error('status') is-invalid @enderror"
                                        id="status">
                                        <option value="">Pilih Status</option>
                                        <option value="waiting" {{ $order->status == 'waiting' ? 'selected' : '' }}>
                                            🕐 Menunggu
                                        </option>
                                        <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>
                                            ⚙️ Sedang Diproses
                                        </option>
                                        <option value="onpayment" {{ $order->status == 'onpayment' ? 'selected' : '' }}>
                                            💳 Pembayaran
                                        </option>
                                        <option value="onpayment_waiting"
                                            {{ $order->status == 'onpayment_waiting' ? 'selected' : '' }}>
                                            ⏳ Menunggu Pembayaran
                                        </option>
                                        <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>
                                            ✅ Siap
                                        </option>
                                        <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>
                                            ❌ Dibatalkan
                                        </option>
                                        <option value="finish" {{ $order->status == 'finish' ? 'selected' : '' }}>
                                            🎉 Selesai
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Status pesanan akan mempengaruhi proses selanjutnya
                                    </small>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex gap-3 justify-content-end pt-3 border-top">
                                <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary btn-lg px-4 py-2">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-gradient text-white btn-lg px-4 py-2">
                                    <i class="fas fa-save me-2"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Card -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle p-3 text-white me-3">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Informasi Penting</h6>
                                        <small class="text-muted">Perhatikan detail pesanan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success rounded-circle p-3 text-white me-3">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Auto Calculate</h6>
                                        <small class="text-muted">Total akan dihitung otomatis</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning rounded-circle p-3 text-white me-3">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">Hati-hati</h6>
                                        <small class="text-muted">Perubahan tidak dapat dibatalkan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto calculate total when weight changes
        document.getElementById('weight').addEventListener('input', function() {
            const weight = parseFloat(this.value) || 0;
            const priceText = document.getElementById('price').value;
            const price = parseFloat(priceText.replace(/[^0-9]/g, ''));

            if (weight > 0 && price > 0) {
                const total = weight * price;
                console.log('Calculated total:', total);
                // You can add visual feedback here if needed
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const weight = document.getElementById('weight').value;
            const status = document.getElementById('status').value;

            if (!weight || weight <= 0) {
                e.preventDefault();
                alert('Berat harus diisi dan lebih dari 0');
                document.getElementById('weight').focus();
                return;
            }

            if (!status) {
                e.preventDefault();
                alert('Status harus dipilih');
                document.getElementById('status').focus();
                return;
            }
        });

        // Success notification (if you want to add it)
        @if (session('success'))
            // You can add toast notification here
            console.log('Success: {{ session('success') }}');
        @endif
    </script>
@endsection
