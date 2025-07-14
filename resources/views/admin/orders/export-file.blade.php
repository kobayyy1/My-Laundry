@extends('admin.layouts.panel')

@section('head')
@endsection
@section('body')

    <div class="header">
        <h1>LAPORAN ORDER LAUNDRY</h1>
        <p>Tanggal Export:{{ now()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y H:i') }} WIB</p>
        <p>Total Data: {{ $orders->count() }} Orders</p>
    </div>

    @if ($filters['search'] || $filters['status'] || $filters['date_from'] || $filters['date_to'])
        <div class="info-section">
            <h3>Filter yang Diterapkan:</h3>
            @if ($filters['search'])
                <p>• Pencarian: {{ $filters['search'] }}</p>
            @endif
            @if ($filters['status'])
                <p>• Status: {{ ucfirst($filters['status']) }}</p>
            @endif
            @if ($filters['date_from'])
                <p>• Tanggal Mulai: {{ \Carbon\Carbon::parse($filters['date_from'])->format('d F Y') }}</p>
            @endif
            @if ($filters['date_to'])
                <p>• Tanggal Selesai: {{ \Carbon\Carbon::parse($filters['date_to'])->format('d F Y') }}</p>
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Invoice</th>
                <th style="width: 15%;">Pelanggan</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 8%;">Berat (KG)</th>
                <th style="width: 12%;">Harga/KG</th>
                <th style="width: 13%;">Total Harga</th>
                <th style="width: 10%;">Telepon</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $index => $order)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->username }}</td>
                    <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-center">
                        <span class="status-{{ $order->status }}">{{ $order->status_text }}</span>
                    </td>
                    <td class="text-center">{{ number_format($order->weight ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($order->price ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    <td>{{ $order->phone ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data yang ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <h3>Ringkasan:</h3>
        <p><strong>Total Berat:</strong> {{ number_format($totalWeight, 0, ',', '.') }} KG</p>
        <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
        <p><strong>Jumlah Order:</strong> {{ $orders->count() }} Orders</p>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem LaundryKu pada {{ now()->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y H:i') }} WIB
        </p>
    </div>
@endsection
