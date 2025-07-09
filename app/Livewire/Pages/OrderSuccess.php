<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\orders;

class OrderSuccess extends Component
{
    public $orders;
    public $ordersitem;

    public function mount($orderId)
    {
        $this->ordersitem = $orderId;
        $this->orders = orders::with('items')->findOrFail($orderId);
    }

    public function render()
    {
        return view('livewire.pages.order-success');
    }
}

