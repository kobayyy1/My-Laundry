<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 text-center">
        <div class="text-green-500 text-6xl mb-4">✓</div>
        <h1 class="text-3xl font-bold text-green-600 mb-4">Pesanan Berhasil!</h1>
        <p class="text-gray-600 mb-6">Terima kasih telah berbelanja. Pesanan Anda sedang diproses.</p>
        
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan</h2>
            <div class="text-left space-y-2">
                <div class="flex justify-between">
                    <span>Order ID:</span>
                    <span class="font-medium">#{{ $order->order_id }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Nama:</span>
                    <span>{{ $order->username }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Telepon:</span>
                    <span>{{ $order->phone }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Total:</span>
                    <span class="font-bold">Rp {{ number_format($order->gran_total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Status:</span>
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">{{ ucfirst($order->status) }}</span>
                </div>
            </div>
        </div>

        <div class="space-x-4">
            <a href="{{ route('product.data') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Lanjut Belanja
            </a>
            <a href="{{ route('order.detail', $order->order_id) }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Lihat Detail
            </a>
        </div>
    </div>
</div>
