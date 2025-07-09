<?php

namespace App\Livewire\Admin\Transaction;

use Livewire\Component;
use App\Models\orders;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    public $search = '', $pages = 5, $status = '';
    public $selected = [], $selectedAll = false, $syarat = false;
    public $selected_id;
    protected $listeners = ["DeleteActionGo"];

    // Reset pagination when search/filter changes
    public function updatingSearch()
    {
        $this->resetPage();
        $this->resetSelection();
    }

    public function updatingStatus()
    {
        $this->resetPage();
        $this->resetSelection();
    }

    public function updatingPages()
    {
        $this->resetPage();
        $this->resetSelection();
    }

    // Method untuk reset selection
    private function resetSelection()
    {
        $this->selected = [];
        $this->selectedAll = false;
    }

    public function clickSelected()
    {
        if ($this->selectedAll == true) {
            // Get current page items only for selection
            $orders = $this->getOrdersQuery()->paginate($this->pages);
            $this->selected = [];
            foreach ($orders as $order) {
                $this->selected[] = $order->orders_id;
            }
        } else {
            $this->selected = [];
        }
    }

    public function clickSelectedOne()
    {
        // Check if all current page items are selected
        $orders = $this->getOrdersQuery()->paginate($this->pages);
        $currentPageIds = [];
        foreach ($orders as $order) {
            $currentPageIds[] = $order->orders_id;
        }

        $selectedCurrentPage = array_intersect($this->selected, $currentPageIds);
        $this->selectedAll = count($selectedCurrentPage) === count($currentPageIds) && count($currentPageIds) > 0;
    }

    public function DeleteAction($id)
    {
        $this->selected_id = $id;
        $this->dispatch('deleteModel');
    }

    public function DeleteActionGo()
    {
        try {
            orders::find($this->selected_id)->delete();
            $this->dispatch('deleteModelSuccess');

            // Reset selection after delete
            $this->resetSelection();
        } catch (\Throwable $th) {
            $this->dispatch('deleteModelError');
        }
    }

    public function DeleteActionAll()
    {
        $this->syarat = false;
        try {
            orders::whereIn('orders_id', $this->selected)->delete();
            $this->dispatch('deleteModelAll');

            // Reset selection after delete
            $this->resetSelection();
        } catch (\Throwable $th) {
            $this->dispatch('deleteModelError');
        }
    }

    // Build the query for orders
    private function getOrdersQuery()
    {
        $query = orders::query();

        // Apply search filter
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('invoice', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%');
            });
        }

        // Apply status filter
        if (!empty($this->status)) {
            $query->where('status', $this->status);
        }

        // Order by created_at desc for consistent pagination
        $query->orderBy('created_at', 'desc');

        return $query;
    }

    public function render()
    {
        $orders = $this->getOrdersQuery()->paginate($this->pages);

        // Calculate grand total for each order
        foreach ($orders as $item) {
            if ($item->weight && $item->price) {
                $item->grand_total = $item->price * $item->weight;
            } else {
                $item->grand_total = 0;
            }
        }

        return view('livewire.admin.transaction.data', [
            'orders' => $orders
        ]);
    }
}
