<div class="py-5">
    <div class="container pt-5">
        <div class="title">
            <h1 class="mb-0">Pesanan Saya</h1>
            <p class="mb-0">Kelola informasi pesanan anda</p>
        </div>
        <hr class="soft">
        <div class="content">
            @if ($dataOrder->isEmpty())
                <div class="alert alert-info">
                    <h4 class="mb-0">Anda belum memiliki pesanan.</h4>
                </div>
            @else
                @foreach ($dataOrder as $item)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header d-flex justify-content-between">
                            <span><strong>Order:</strong> {{ $item->invoice }}</span>
                            <span
                                class="badge 
                                @if ($item->status === 'pending') bg-warning
                                @elseif ($item->status === 'completed') bg-success
                                @else bg-secondary @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-4"><strong>Tanggal</strong></div>
                                <div class="col-8">: {{ $item->created_at->format('d M Y H:i') }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>Harga/KG</strong></div>
                                <div class="col-8">
                                    : Rp{{ number_format($item->price ?? 0, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>Berat</strong></div>
                                <div class="col-8">
                                    : {{ $item->weight ? number_format($item->weight, 1) . ' kg' : '-' }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>Harga Total</strong></div>
                                <div class="col-8">
                                    : Rp{{ $item->grand_total ? number_format($item->grand_total, 0, ',', '.') : '-' }}
                                </div>
                            </div>

                            <div class="mt-3 text-end">
                                <a href="{{route('order.detail',$item->orders_id)}} " class="btn btn-outline-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
