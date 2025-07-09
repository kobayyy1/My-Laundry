@extends('admin.layouts.panel')

@section('body')
    <div class="container mt-4">
        <h4>Edit Pesanan</h4>
        <hr>
        <form action="{{ route('admin.orders.update.post', $order->orders_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="username" class="form-label">Pelanggan</label>
                <input type="text" class="form-control" id="username" value="{{ $order->username }}" readonly>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga Per Kg</label>
                <input type="text" class="form-control" id="price"
                    value="Rp. {{ number_format($order->price, 0, ',', '.') }}" readonly>
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Berat (KG)</label>
                <input type="number" name="weight" class="form-control" id="weight"
                    value="{{ old('weight', $order->weight) }}">
            </div>


            {{-- <div class="mb-3">
                <label for="grand_total" class="form-label">Grand Total</label>
                <input type="number" name="grand_total" class="form-control" id="grand_total"
                    value="{{ old('grand_total', $order->grand_total) }}">
            </div> --}}

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="waiting" {{ $order->status == 'waiting' ? 'selected' : '' }}>waiting</option>
                    <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>Processing
                    </option>
                    <option value="onpayment" {{ $order->status == 'onpayment_waiting' ? 'selected' : '' }}>On_payment
                    </option>
                    <option value="onpayment_waiting" {{ $order->status == 'onpayment_waiting' ? 'selected' : '' }}>Menunggu
                        Pembayaran</option>
                    <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>ready</option>
                    <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                    <option value="finish" {{ $order->status == 'finish' ? 'selected' : '' }}>finish</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan</button>
            <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
