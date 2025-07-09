<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\ordersItems;
use App\Models\orders;
use Illuminate\Support\Facades\DB;

class Cart extends Component
{
    public $selectedItems = [];
    public $cart = [];
    public $total = 0;
    public $shippingCost = 0;
    public $grandTotal = 0;
    public $totalWeight = 0;

    // Form fields
    public $username = '';
    public $phone = '';
    public $address = '';
    public $notes = '';

    protected $rules = [
        'username' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'shippingCost' => 'numeric|min:0',
    ];

    public function mount()
    {
        $this->loadCart();

        if (empty($this->cart)) {
            return redirect()->route('index')->with('error', 'Keranjang kosong!');
        }
    }

    public function loadCart()
    {
        $this->cart = session()->get('cart', []);
        $this->calculateTotals();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName === 'shippingCost') {
            $this->calculateTotals();
        }
    }

    private function calculateTotals()
    {
        $this->total = 0;
        $this->totalWeight = 0;

        foreach ($this->cart as $item) {
            $itemPrice = $this->getDiscountedPrice($item);
            $this->total += $itemPrice * $item['qty'];
            $this->totalWeight += 1 * $item['qty']; // Sesuaikan jika produk punya berat
        }

        $this->grandTotal = $this->total + $this->shippingCost;
    }

    private function getDiscountedPrice($item)
    {
        if (
            $item['discount'] > 0 &&
            $item['dateDiscountStart'] <= now() &&
            $item['dateDiscountEnd'] >= now()
        ) {
            return $item['price_other'];
        }
        return $item['price'];
    }
    public function goToCheckout()
    {

        if (empty($this->selectedItems)) {
            session()->flash('error', 'Pilih setidaknya satu produk untuk melanjutkan ke checkout.');
            return;
        }

        session()->put('selected_cart', $this->selectedItems);
        return redirect()->route('checkout', ['items' => implode(',', $this->selectedItems)]);
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
        return view('livewire.pages.cart');
    }
}
