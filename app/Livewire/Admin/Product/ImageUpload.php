<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;
    public $post;
    public $photos;
    
    public function render()
    {
        return view('livewire.admin.product.image-upload');
    }
}
