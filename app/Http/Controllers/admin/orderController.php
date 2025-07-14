<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class orderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }
    public function detailorder($id)
    {
        // Hapus pengecekan user karena ini untuk admin
        // Admin harus bisa melihat semua order, bukan hanya milik user tertentu

        $order = orders::with('items.product')
            ->where('orders_id', $id)
            ->firstOrFail();

        $subtotal = 0;
        $totalWeight = 0;

        foreach ($order->items as $item) {
            $itemPrice = $item->price_other ?? $item->price;
            $itemTotal = $itemPrice * $item->qty;

            $subtotal += $itemTotal;
            $totalWeight += $item->qty;

            // Tambahkan properti calculated ke setiap item
            $item->item_total = $itemTotal;
            $item->final_price = $itemPrice;
        }

        // Tambahkan properti calculated ke order
        $order->calculated_subtotal = $subtotal;
        $order->calculated_weight = $totalWeight;

        return view('admin.orders.detail', compact('order'));
    }

    /**
     * Method untuk mendapatkan detail perhitungan order (untuk admin)
     */
    public function getOrderCalculation($orderId)
    {
        // Hapus pengecekan user karena ini untuk admin

        $order = orders::with('items.product')
            ->where('orders_id', $orderId)
            ->firstOrFail();

        $calculation = [
            'order_info' => [
                'order_id' => $order->orders_id,
                'invoice' => $order->invoice,
                'customer_name' => $order->username,
                'customer_phone' => $order->phone,
                'status' => $order->status,
                'created_at' => $order->created_at->format('d F Y H:i')
            ],
            'items' => [],
            'subtotal' => 0,
            'total_weight' => 0,
            'grand_total' => 0
        ];

        foreach ($order->items as $item) {
            $itemPrice = $item->price_other ?? $item->price;
            $itemTotal = $itemPrice * $item->qty;

            $calculation['items'][] = [
                'title' => $item->title,
                'product_name' => $item->product->title ?? $item->title,
                'weight' => $item->qty,
                'price_per_kg' => $itemPrice,
                'item_total' => $itemTotal,
                'formatted_price' => 'Rp ' . number_format($itemPrice, 0, ',', '.'),
                'formatted_total' => 'Rp ' . number_format($itemTotal, 0, ',', '.'),
                'product_status' => $item->product->status ?? null,
                'product_image' => $item->product->image ?? null
            ];

            $calculation['subtotal'] += $itemTotal;
            $calculation['total_weight'] += $item->qty;
        }

        $calculation['grand_total'] = $calculation['subtotal'];
        $calculation['formatted_subtotal'] = 'Rp ' . number_format($calculation['subtotal'], 0, ',', '.');
        $calculation['formatted_grand_total'] = 'Rp ' . number_format($calculation['grand_total'], 0, ',', '.');
        $calculation['formatted_weight'] = number_format($calculation['total_weight'], 0, ',', '.') . ' KG';

        return $calculation;
    }

    public function update($id)
    {
        $order = orders::findOrFail($id);
        return view('admin.orders.updateorders', [
            'order' => $order
        ]);
    }
    public function updatepost(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:waiting,onpayment,pending,process,onpayment_waiting,ready,finish',
            'weight'  => 'nullable|numeric|min:0',
        ]);

        $order = Orders::findOrFail($id);

        $weight = $request->weight ?? 0;
        $pricePerKg = ($order->discount && $order->discount > 0) ? $order->price_other : $order->price;
        $grandTotal = $weight > 0 ? $pricePerKg * $weight : 0;

        $order->update([
            'status'       => $request->status,
            'weight'       => $weight,
            'total'        => 0,
            'grand_total'  => $grandTotal,
        ]);

        return redirect()->route('admin.orders.update', $order->orders_id)->with('success', 'Pesanan berhasil diperbarui.');
    }
    public function downloadInvoice($id)
    {
        try {
            $order = orders::with('items.product')
                ->where('orders_id', $id)
                ->firstOrFail();

            $subtotal = 0;
            $totalWeight = 0;

            foreach ($order->items as $item) {
                $itemPrice = $item->price_other ?? $item->price;
                $itemTotal = $itemPrice * $item->qty;

                $subtotal += $itemTotal;
                $totalWeight += $item->qty;

                $item->item_total = $itemTotal;
                $item->final_price = $itemPrice;
            }

            $order->calculated_subtotal = $subtotal;
            $order->calculated_weight = $totalWeight;

            // Render view ke HTML dengan view yang sederhana
            $html = view('admin.orders.invoice-pdf', compact('order'))->render();

            // Menggunakan DomPDF untuk generate PDF
            $pdf = PDF::loadHTML($html);

            // Set paper size dan orientasi
            $pdf->setPaper('A4', 'portrait');

            // Set options yang lebih sederhana untuk menghindari error
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => false,
                'defaultFont' => 'Arial',
                'defaultMediaType' => 'print',
                'enable_remote' => false
            ]);

            // PERBAIKAN: Bersihkan nama file dari karakter yang tidak diizinkan
            $invoiceNumber = preg_replace('/[\/\\\\:*?"<>|]/', '_', $order->invoice);
            $fileName = 'invoice-' . $invoiceNumber . '.pdf';

            // Download PDF dengan nama file yang aman
            return $pdf->download($fileName);
        } catch (\Exception $e) {

            // Return error response
            return response()->json([
                'error' => 'Gagal membuat PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    public function printOrder($id)
    {
        $order = orders::with('items.product')
            ->where('orders_id', $id)
            ->firstOrFail();

        $subtotal = 0;
        $totalWeight = 0;

        foreach ($order->items as $item) {
            $itemPrice = $item->price_other ?? $item->price;
            $itemTotal = $itemPrice * $item->qty;

            $subtotal += $itemTotal;
            $totalWeight += $item->qty;

            $item->item_total = $itemTotal;
            $item->final_price = $itemPrice;
        }

        $order->calculated_subtotal = $subtotal;
        $order->calculated_weight = $totalWeight;

        return view('admin.orders.print', compact('order'));
    }
}
