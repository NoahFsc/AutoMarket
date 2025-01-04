<?php

namespace App\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;

class OffersCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteOffer($carId)
    {
        Car::find($carId)->delete();
    }

    public function render()
    {
        $cars = Car::whereHas('typeOfCar', function ($query) {
            $query->where('nom', 'like', '%' . $this->search . '%');
        })
            ->orWhereHas('user', function ($query) {
                $query->where('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('first_name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('carModel', function ($query) {
                $query->where('model_name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($query) {
                        $query->where('brand_name', 'like', '%' . $this->search . '%');
                    });
            })
            ->paginate(6);

        return view('components.admin.offers-catalog', ['cars' => $cars]);
    }
}
