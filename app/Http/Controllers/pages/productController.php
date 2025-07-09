<?php

namespace App\Http\Controllers\pages;

use App\Models\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productController extends Controller
{
    public function order($id, $slug)
    {
        try {
            $data = product::find($id);

            if (!$data) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan.');
            }

            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['qty'] += 1;
            } else {
                $cart[$id] = [
                    'product_id' => $data->product_id,
                    'title' => $data->title,
                    'slug' => $data->slug,
                    'price' => $data->price,
                    'discount' => $data->discount,
                    'dateDiscountStart' => $data->dateDiscountStart,
                    'dateDiscountEnd' => $data->dateDiscountEnd,
                    'dateProduct' => $data->dateProduct,
                    'description' => $data->description,
                    'price_other' => $data->price_other,
                    'images' => $data->image,
                    'qty' => 1,
                ];
            }

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan ke keranjang.');
        }
    }
}
