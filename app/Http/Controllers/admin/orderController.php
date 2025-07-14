<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

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

    /**
     * Export All Orders to Excel
     */
    public function exportExcel(Request $request)
    {
        try {
            // Build query with filters
            $query = orders::query();

            // Apply filters if provided
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('invoice', 'like', '%' . $request->search . '%')
                        ->orWhere('username', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            // Get orders with related data
            $orders = $query->orderBy('created_at', 'desc')->get();

            // Create new Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set sheet title
            $sheet->setTitle('Laporan Order Laundry');

            // Header information
            $sheet->setCellValue('A1', 'LAPORAN ORDER LAUNDRY');
            $sheet->setCellValue('A2', 'Tanggal Export: ' . Carbon::now()->format('d F Y H:i'));
            $sheet->setCellValue('A3', 'Total Data: ' . $orders->count() . ' Orders');

            // Style for header
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
            $sheet->getStyle('A2:A3')->getFont()->setSize(12);

            // Column headers
            $headers = [
                'A5' => 'No',
                'B5' => 'Invoice',
                'C5' => 'Pelanggan',
                'D5' => 'Tanggal Order',
                'E5' => 'Status',
                'F5' => 'Berat (KG)',
                'G5' => 'Harga/KG',
                'H5' => 'Total Harga',
                'I5' => 'Nomor Telepon',
            ];

            foreach ($headers as $cell => $header) {
                $sheet->setCellValue($cell, $header);
            }

            // Style for column headers
            $headerRange = 'A5:J5';
            $sheet->getStyle($headerRange)->getFont()->setBold(true);
            $sheet->getStyle($headerRange)->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setRGB('E3F2FD');
            $sheet->getStyle($headerRange)->getBorders()
                ->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            // Data rows
            $row = 6;
            $totalAmount = 0;
            $totalWeight = 0;

            foreach ($orders as $index => $order) {
                // Calculate grand total
                $grandTotal = $order->weight && $order->price ? $order->price * $order->weight : 0;
                $totalAmount += $grandTotal;
                $totalWeight += $order->weight ?? 0;

                // Status mapping
                $statusText = match ($order->status) {
                    'pending' => 'Menunggu',
                    'progress' => 'Sedang Diproses',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => ucfirst($order->status)
                };

                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $order->invoice);
                $sheet->setCellValue('C' . $row, $order->username);
                $sheet->setCellValue('D' . $row, $order->created_at->format('d/m/Y H:i'));
                $sheet->setCellValue('E' . $row, $statusText);
                $sheet->setCellValue('F' . $row, $order->weight ?? 0);
                $sheet->setCellValue('G' . $row, $order->price ?? 0);
                $sheet->setCellValue('H' . $row, $grandTotal);
                $sheet->setCellValue('I' . $row, $order->phone ?? '-');

                $row++;
            }

            // Summary row
            $row++;
            $sheet->setCellValue('A' . $row, 'TOTAL:');
            $sheet->setCellValue('F' . $row, $totalWeight);
            $sheet->setCellValue('H' . $row, $totalAmount);
            $sheet->getStyle('A' . $row . ':J' . $row)->getFont()->setBold(true);

            // Apply borders to all data
            $dataRange = 'A5:J' . ($row);
            $sheet->getStyle($dataRange)->getBorders()
                ->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

            // Auto-size columns
            foreach (range('A', 'J') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

            // Format currency columns
            $sheet->getStyle('G6:H' . $row)->getNumberFormat()
                ->setFormatCode('#,##0');

            // Create writer and save
            $writer = new Xlsx($spreadsheet);
            $fileName = 'laporan-order-laundry-' . Carbon::now()->format('Y-m-d-H-i-s') . '.xlsx';
            $tempPath = storage_path('app/temp/' . $fileName);

            // Ensure temp directory exists
            if (!file_exists(dirname($tempPath))) {
                mkdir(dirname($tempPath), 0755, true);
            }

            $writer->save($tempPath);

            return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengexport data: ' . $e->getMessage());
        }
    }

    /**
     * Export All Orders to PDF
     */
    public function exportPDF(Request $request)
    {
        try {
            // Build query with filters
            $query = orders::query();

            // Apply filters if provided
            if ($request->filled('search')) {
                $query->where(function ($q) use ($request) {
                    $q->where('invoice', 'like', '%' . $request->search . '%')
                        ->orWhere('username', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }

            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            // Get orders
            $orders = $query->orderBy('created_at', 'desc')->get();

            // Calculate totals
            $totalAmount = 0;
            $totalWeight = 0;

            foreach ($orders as $order) {
                $grandTotal = $order->weight && $order->price ? $order->price * $order->weight : 0;
                $totalAmount += $grandTotal;
                $totalWeight += $order->weight ?? 0;

                // Add calculated fields
                $order->grand_total = $grandTotal;
                $order->status_text = match ($order->status) {
                    'pending' => 'Menunggu',
                    'progress' => 'Sedang Diproses',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                    default => ucfirst($order->status)
                };
            }

            $data = [
                'orders' => $orders,
                'totalAmount' => $totalAmount,
                'totalWeight' => $totalWeight,
                'exportDate' => Carbon::now()->format('d F Y H:i'),
                'filters' => [
                    'search' => $request->search,
                    'status' => $request->status,
                    'date_from' => $request->date_from,
                    'date_to' => $request->date_to
                ]
            ];

            // Generate PDF
            $pdf = PDF::loadView('admin.orders.export-file', $data);
            $pdf->setPaper('A4', 'landscape');
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => false,
                'defaultFont' => 'Arial',
                'defaultMediaType' => 'print',
                'enable_remote' => false
            ]);

            $fileName = 'laporan-order-laundry-' . Carbon::now()->format('Y-m-d-H-i-s') . '.pdf';

            return $pdf->download($fileName);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengexport PDF: ' . $e->getMessage());
        }
    }
}
