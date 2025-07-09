<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\orders;
use App\Models\ordersItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Checkout extends Component
{
    public $selectedItems = [];
    public function mount()
    {
        $this->selectedItems = session('selected_cart', []);
    }

    public function placeOrder()
    {
        $user = Auth::guard('users')->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (empty($this->selectedItems)) {
            $this->dispatch('error', 'Pilih produk terlebih dahulu untuk dipesan!');
            return;
        }

        $cart = session('cart', []);
        $selectedCartItems = array_filter($cart, function ($item) {
            return in_array($item['product_id'], $this->selectedItems);
        });

        if (empty($selectedCartItems)) {
            $this->dispatch('error', 'Tidak ada produk valid yang dipilih!');
            return;
        }

        try {
            $priceperkg = 0;

            foreach ($selectedCartItems as $item) {
                // Ambil harga sesuai diskon
                $price = $item['discount'] > 0 ? $item['price_other'] : $item['price'];
                $priceperkg += $price * $item['qty'];
            }

            // Simpan pesanan ke database
            $order = orders::create([
                'username'     => $user->username,
                'invoice'      => 'INV/' . now()->format('ymd') . '/' . strtoupper(Str::random(6)),
                'phone'        => $user->phone,
                'user_id'      => $user->user_id,
                'total'        => 0,                
                'grand_total'  => 0,                
                'price'        => $priceperkg,     
                'status'       => 'waiting',
                'weight'       => 0,                
            ]);

            foreach ($selectedCartItems as $item) {
                ordersItems::create([
                    'orders_id'   => $order->orders_id,
                    'title'       => $item['title'],
                    'price'       => $item['price'],
                    'price_other' => $item['price_other'] ?? 0,
                    'qty'         => $item['qty'],
                    'product_id'  => $item['product_id'],
                ]);
            }

            // Hapus item yang sudah diorder dari keranjang
            $remainingCart = array_filter($cart, function ($item) {
                return !in_array($item['product_id'], $this->selectedItems);
            });

            session()->put('cart', $remainingCart);
            $this->selectedItems = [];

            $this->dispatch('success', 'Yeayyyy! Pesanan berhasil dibuat.');
            return redirect()->route('index');
        } catch (\Throwable $e) {
            $this->dispatch('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }


    public function removeSession($productId)
    {
        $cart = session('cart', []);

        // Cek dan hapus hanya jika item ada
        foreach ($cart as $index => $item) {
            if ($item['product_id'] == $productId) {
                unset($cart[$index]);
                session()->put('cart', $cart);
                $this->dispatch('success', 'Produk berhasil dihapus dari keranjang!');
                return;
            }
        }

        $this->dispatch('error', 'Produk tidak ditemukan di keranjang.');
    }

    public function render()
    {
        $cart = session('cart', []);

        $selectedCartItems = array_filter($cart, function ($item) {
            return in_array($item['product_id'], $this->selectedItems);
        });

        return view('livewire.pages.checkout', [
            'selectedCartItems' => $selectedCartItems
        ]);
    }
}
