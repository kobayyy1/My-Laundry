<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Support\Facades\Auth;

class orderdetailController extends Controller
{
    public function orderdetail($id)
    {
        $user = Auth::guard('users')->user();

        $order = orders::with('items.product')
            ->where('user_id', $user->user_id)
            ->where('orders_id', $id)
            ->firstOrFail();

        // Perhitungan untuk setiap item dan subtotal
        $subtotal = 0;
        $totalWeight = 0;

        foreach ($order->items as $item) {
            // Gunakan price dari ordersItems (harga saat order dibuat)
            $itemPrice = $item->price_other ?? $item->price;

            // Hitung total per item (qty * price)
            $itemTotal = $itemPrice * $item->qty;

            // Tambahkan ke subtotal
            $subtotal += $itemTotal;

            // Tambahkan qty ke total (anggap qty sebagai weight dalam KG)
            $totalWeight += $item->qty;

            // Tambahkan data perhitungan ke item untuk digunakan di view
            $item->item_total = $itemTotal;
            $item->final_price = $itemPrice;
        }

        // Update order dengan perhitungan terbaru
        $order->calculated_subtotal = $subtotal;
        $order->calculated_weight = $totalWeight;

        return view('pages.orderdetail', compact('order'));
    }

    /**
     * Method untuk mendapatkan detail perhitungan order
     */
    public function getOrderCalculation($orderId)
    {
        $user = Auth::guard('users')->user();

        $order = orders::with('items.product')
            ->where('user_id', $user->user_id)
            ->where('orders_id', $orderId)
            ->firstOrFail();

        $calculation = [
            'items' => [],
            'subtotal' => 0,
            'total_weight' => 0,
            'grand_total' => 0
        ];

        foreach ($order->items as $item) {
            $itemPrice = $item->price_other ?? $item->price;
            $itemTotal = $itemPrice * $item->qty;

            $calculation['items'][] = [
                'product_name' => $item->title, // Gunakan title dari ordersItems
                'weight' => $item->qty,
                'price_per_kg' => $itemPrice,
                'item_total' => $itemTotal,
                'formatted_price' => 'Rp ' . number_format($itemPrice, 0, ',', '.'),
                'formatted_total' => 'Rp ' . number_format($itemTotal, 0, ',', '.')
            ];

            $calculation['subtotal'] += $itemTotal;
            $calculation['total_weight'] += $item->qty;
        }

        $calculation['grand_total'] = $calculation['subtotal'];
        $calculation['formatted_subtotal'] = 'Rp ' . number_format($calculation['subtotal'], 0, ',', '.');
        $calculation['formatted_grand_total'] = 'Rp ' . number_format($calculation['grand_total'], 0, ',', '.');

        return $calculation;
    }
}
