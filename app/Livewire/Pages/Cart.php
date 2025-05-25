<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Cart extends Component
{
    public function removeSession($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    public function render()
    {
        return view('livewire..pages.cart');
    }
}
