<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;

class ProductDescription extends Component
{
    public $post;
    public $InputText = [""];

    public function addInput(){
        array_push($this->InputText, "");
    }

    public function delInput($que)
    {
        // dd($que);
        unset($this->InputText[$que]);
    }

    public function mount()
    {
        if($this->post)
        {
            $this->InputText = [];
            $this->InputText = array_values($this->post);
        }
    }

    public function render()
    {
        return view('livewire.admin.product.product-description');
    }
}
