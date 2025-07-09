@extends('admin.layouts.panel')

@section('head')
    <title>Wellcome to applikasi admin laundyku</title>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-block p-3 mb-2">
            <h2 class="text-them fw-bold mb-0">LaundryKu</h2>
            <p class="text-them-sec mb-0">Selamat datang kembali di aplikasi laundryku</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-light p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-money-bill fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">{{ $orders }} </p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Transaction</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-users fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">{{ $customer }} </p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Costumer</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="d-block rounded bg-white p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <i class="fas fa-box fa-3x fa-fw text-them"></i>
                        <p class="mb-0 fs-1 text-them-sec">{{ $product }}</p>
                    </div>
                    <hr class="soft my-1">
                    <p class="text-them fw-bold text-end mb-0">Product</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1>Waiting Order</h1>

        @if ($orderswaiting->isEmpty())
            <p>Tidak ada pesanan dengan status "waiting".</p>
        @else
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-them">NO</th>
                <th class="text-them">Invoice</th>
                <th class="text-them">Pelanggan</th>
                <th class="text-them">Tanggal</th>
                <th class="text-them">Berat(KG)</th>
                <th class="text-them">Harga/KG</th>
                <th class="text-them">Status</th>
                <th class="text-them">Grand Total</th>
                <th class="text-them"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderswaiting as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->invoice }}</td>
                    <td>{{ $order->username }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $order->weight }}</td>
                    <td>{{ $order->price }}</td>
                    <td>
                        <div class="mb-3">
                            <form action="{{ route('admin.orders.update.post', $order->orders_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="waiting" {{ $order->status == 'waiting' ? 'selected' : '' }}>
                                        Waiting</option>
                                    <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="onpayment" {{ $order->status == 'onpayment' ? 'selected' : '' }}>On
                                        Payment</option>
                                    <option value="onpayment_waiting"
                                        {{ $order->status == 'onpayment_waiting' ? 'selected' : '' }}>Menunggu
                                        Pembayaran</option>
                                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready
                                    </option>
                                    <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>
                                        Cancel</option>
                                    <option value="finish" {{ $order->status == 'finish' ? 'selected' : '' }}>
                                        Finish</option>
                                </select>
                            </form>
                        </div>
                    </td>
                    <td>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>

@endsection

@section('script')
@endsection
