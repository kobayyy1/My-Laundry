@extends('admin.layouts.panel')
@section('head')
    <title>Invoice View</title>
@endsection
@section('body')
@endsection



<!-- Dalam view admin.orders.invoice -->
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        line-height: 1.4;
    }

    .invoice-header {
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .text-right {
        text-align: right;
    }

    .total-row {
        font-weight: bold;
        background-color: #f9f9f9;
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
<>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <h1>INVOICE</h1>
            <p>Invoice #{{ $order->invoice }}</p>
            <p>{{ $order->created_at->locale('id')->translatedFormat('d F Y H:i') }} WIB</p>
        </div>

        <!-- Invoice Information -->
        <div class="invoice-info">
            <div class="invoice-info-left">
                <div class="info-box">
                    <h3>Informasi Pesanan</h3>
                    <div class="info-row">
                        <strong>No. Pesanan:</strong>
                        <span class="price-highlight">{{ $order->invoice }}</span>
                    </div>
                    <div class="info-row">
                        <strong>Tanggal Order:</strong>
                        {{ $order->created_at->locale('id')->translatedFormat('d F Y H:i') }} WIB
                    </div>
                    <div class="info-row">
                        <strong>Status:</strong>
                        <span class="status-badge">{{ ucfirst($order->status) }}</span>
                    </div>
                </div>
            </div>
            <div class="invoice-info-right">
                <div class="info-box">
                    <h3>Data Customer</h3>
                    <div class="info-row">
                        <strong>Nama:</strong>
                        {{ $order->username }}
                    </div>
                    <div class="info-row">
                        <strong>No. Telepon:</strong>
                        {{ $order->phone }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="products-section">
            <h3 class="section-title">Detail Produk</h3>
            <table class="products-table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 40%">Nama Produk</th>
                        <th style="width: 15%" class="text-center">Berat (KG)</th>
                        <th style="width: 20%" class="text-right">Harga Satuan</th>
                        <th style="width: 20%" class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                                @if ($item->product && $item->product->description)
                                    <br><small
                                        style="color: #666;">{{ Str::limit($item->product->description, 50) }}</small>
                                @endif
                            </td>
                            <td class="text-center">{{ number_format($item->qty, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($item->final_price, 0, ',', '.') }}</td>
                            <td class="text-right price-highlight">Rp
                                {{ number_format($item->item_total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary Section -->
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
                    <strong>{{ number_format($order->weight ?? $order->calculated_weight, 0, ',', '.') }} KG</strong>
                </div>
            </div>

            <div class="summary-row total-row">
                <div class="summary-label">TOTAL PEMBAYARAN:</div>
                <div class="summary-value">Rp
                    {{ number_format($order->grand_total ?? $order->calculated_subtotal, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda kepada kami.</p>
            <p>Invoice ini digenerate secara otomatis pada {{ now()->locale('id')->translatedFormat('d F Y H:i') }} WIB
            </p>
        </div>
    </div>
