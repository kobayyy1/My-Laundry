<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->orders_id }} - Print</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            .print-container {
                box-shadow: none !important;
                border: none !important;
            }

            body {
                background: white !important;
                -webkit-print-color-adjust: exact;
            }
        }

        .print-container {
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
        }

        .company-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            margin: -1.5rem -1.5rem 1.5rem -1.5rem;
            padding: 2rem 1.5rem;
        }

        .order-badge {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .info-card {
            border-left: 4px solid #007bff;
            background: #f8f9fa;
        }

        .table-custom th {
            background: #e9ecef;
            color: #495057;
            font-weight: 600;
            border-color: #dee2e6;
        }

        .summary-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .total-amount {
            background: #007bff;
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
        }
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: white;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .invoice-header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .invoice-header h1 {
            color: #007bff;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .invoice-header p {
            color: #666;
            font-size: 14px;
        }

        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .invoice-info-left,
        .invoice-info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .invoice-info-right {
            text-align: right;
        }

        .info-box {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .info-box h3 {
            color: #007bff;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-row strong {
            display: inline-block;
            width: 120px;
            color: #333;
        }

        .products-section {
            margin-bottom: 30px;
        }

        .section-title {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            margin-bottom: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .products-table th,
        .products-table td {
            border: 1px solid #ddd;
            padding: 12px 8px;
            text-align: left;
        }

        .products-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .products-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .price-highlight {
            color: #007bff;
            font-weight: bold;
        }

        .summary-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 30px;
        }

        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .summary-label,
        .summary-value {
            display: table-cell;
            padding: 5px 0;
        }

        .summary-label {
            width: 70%;
            text-align: left;
        }

        .summary-value {
            width: 30%;
            text-align: right;
        }

        .total-row {
            border-top: 2px solid #007bff;
            padding-top: 15px;
            margin-top: 15px;
        }

        .total-row .summary-label,
        .total-row .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 11px;
        }

        .status-badge {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }

        @media print {
            body {
                font-size: 11px;
            }

            .invoice-container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="print-container p-4 mx-auto" style="max-width: 900px;">

            <!-- Header -->
            <div class="company-header text-center">
                <h1 class="mb-1">
                    <i class="fas fa-store me-2"></i>
                    My Laundry Kobay
                </h1>
                <p class="mb-3">Complete Order Management System</p>
                <div class="order-badge d-inline-block px-3 py-1 rounded">
                    <strong>Order Invoice #{{ $order->orders_id }}</strong>
                </div>
            </div>

            <!-- Print Button -->
            <div class="text-end mb-4 no-print">
                <button class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print Order
                </button>
                <button class="btn btn-secondary ms-2" onclick="window.close()">
                    <i class="fas fa-times me-2"></i>Close
                </button>
            </div>

            <!-- Order Information -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-card p-3 h-100">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>Order Details
                        </h5>
                        <div class="row">
                            <div class="col-5"><strong>Order ID:</strong></div>
                            <div class="col-7">#{{ $order->orders_id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Order Date:</strong></div>
                            <div class="col-7">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Status:</strong></div>
                            <div class="col-7">
                                <span
                                    class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($order->status ?? 'Processing') }}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Total Weight:</strong></div>
                            <div class="col-7">{{ $order->calculated_weight }} items</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-card p-3 h-100">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-user me-2"></i>Customer Information
                        </h5>
                        <div class="row">
                            <div class="col-4"><strong>Name:</strong></div>
                            <div class="col-8">{{ $order->username ?? 'N/A' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><strong>Phone:</strong></div>
                            <div class="col-8">{{ $order->phone ?? 'N/A' }}</div>
                        </div>
                        <div class="row">
                            <div class="col-4"><strong>Address:</strong></div>
                            <div class="col-8">{{ $order->contry ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="mb-4">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-shopping-cart me-2"></i>Order Items
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-custom">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="35%">Product Name</th>
                                <th width="15%" class="text-center">Quantity</th>
                                <th width="15%" class="text-end">Unit Price</th>
                                <th width="15%" class="text-end">Total Price</th>
                                <th width="15%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $item->product->name ?? 'Product Not Found' }}
                                        </div>
                                        @if ($item->product->sku ?? false)
                                            <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ $item->qty }}</span>
                                    </td>
                                    <td class="text-end">
                                        Rp {{ number_format($item->final_price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end fw-semibold">
                                        Rp {{ number_format($item->item_total, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Ready
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="summary-section">
                <h3 style="margin-bottom: 20px; color: #007bff;">Rincian Pembayaran</h3>

                @foreach ($order->items as $item)
                    <div class="summary-row">
                        <div class="summary-label">{{ $item->title }} ({{ $item->qty }} KG)</div>
                        <div class="summary-value">Rp {{ number_format($item->item_total, 0, ',', '.') }}</div>
                    </div>
                @endforeach

                <div class="summary-row" style="border-top: 1px solid #ddd; padding-top: 10px; margin-top: 10px;">
                    <div class="summary-label"><strong>Subtotal:</strong></div>
                    <div class="summary-value"><strong>Rp
                            {{ number_format($order->calculated_subtotal, 0, ',', '.') }}</strong></div>
                </div>

                <div class="summary-row">
                    <div class="summary-label"><strong>Total Berat:</strong></div>
                    <div class="summary-value">
                        <strong>{{ number_format($order->weight ?? $order->calculated_weight, 0, ',', '.') }}
                            KG</strong>
                    </div>
                </div>

                <div class="summary-row total-row">
                    <div class="summary-label">TOTAL PEMBAYARAN:</div>
                    <div class="summary-value">Rp
                        {{ number_format($order->grand_total ?? $order->calculated_subtotal, 0, ',', '.') }}</div>
                </div>
            </div>


            <!-- Notes Section -->
            @if ($order->notes ?? false)
                <div class="mt-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-sticky-note me-2"></i>Order Notes
                    </h5>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ $order->notes }}
                    </div>
                </div>
            @endif

            <!-- Footer -->
            <div class="text-center mt-5 pt-4 border-top">
                <p class="text-muted mb-1">
                    <i class="fas fa-heart text-danger me-1"></i>
                    Thank you for your business!
                </p>
                <p class="text-muted small">
                    Generated on {{ \Carbon\Carbon::now()->format('d M Y, H:i:s') }}
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // }

        // Close window after printing
        window.onafterprint = function() {
            // window.close();
        }
    </script>
</body>

</html>
