<?php

namespace App\Livewire\User;

use App\Models\orders;
use Livewire\Component;

class UserOrder extends Component
{
    public $dataOrder;
    public function render()
    {
        $user = auth('users')->user();

        $this->dataOrder = orders::where('user_id', $user->user_id)->get();
        return view('livewire..user.user-order');
    }
}
