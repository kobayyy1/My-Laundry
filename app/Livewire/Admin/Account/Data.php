<?php

namespace App\Livewire\Admin\Account;

use App\Models\admins;
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
            $this->selected = admins::pluck('admin_id')->toArray();
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
            admins::find($this->selected_id)->delete();
            $this->dispatch('deleteModelSuccess');
        } catch (\Throwable $th) {
            $this->dispatch('deleteModelError');
        }
    }

    public function DeleteActionAll()
    {
        $this->syarat = false;
        try {
            admins::whereIn('admin_id',$this->selected)->delete();
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
        $data = admins::paginate($this->pages);
        return view('livewire.admin.account.data',[
            'data' => $data
        ]);
    }
}
