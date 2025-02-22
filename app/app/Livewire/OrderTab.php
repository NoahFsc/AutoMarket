<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class OrderTab extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->whereHas('car.carModel.brand', function ($query) {
                $query->where('brand_name', 'like', '%' . $this->search . '%')
                    ->orWhere('model_name', 'like', '%' . $this->search . '%');
            })
            ->paginate(6);

        return view('components.order-tab', ['orders' => $orders]);
    }
}