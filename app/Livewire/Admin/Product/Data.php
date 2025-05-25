<?php

namespace App\Livewire\Admin\Product;

use App\Models\product;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search, $pages = 5, $status;
    public $selected = [], $selectedAll = false, $syarat = false;
    public $selected_id;

    protected $listeners = ["DeleteActionGo"];

    public function clickSelected()
    {
        if ($this->selectedAll == true) {
            $this->selected = product::pluck('product_id')->toArray();
        } else {
            $this->selected = [];
        }
    }
    public function clickSelectedOne()
    {
        if ($this->selectedAll == true) {
            $this->selectedAll = false;
        }
    }

    public function DeleteAction($id)
    {
        $this->selected_id = $id;
        $this->dispatch('deleteModel');
    }

    public function DeleteActionGo()
    {
        try {
            product::find($this->selected_id)->delete();
            $this->dispatch('deleteModelSuccess');
        } catch (\Throwable $th) {
            $this->dispatch('deleteModelError');
        }
    }

    public function DeleteActionAll()
    {
        $this->syarat = false;
        try {
            product::whereIn('product_id',$this->selected)->delete();
            $this->dispatch('deleteModelAll');
        } catch (\Throwable $th) {
            $this->dispatch('deleteModelError');
        }
    }

    public function searchPush()
    {
        $this->search;
    }
    
    public function render()
    {
        $data = product::paginate($this->pages);
        return view('livewire.admin.product.data', [
            'data' => $data
        ]);
    }
}
