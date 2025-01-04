<?php

namespace App\Livewire\FuelType;

use App\Models\ReferentielsFuelType;
use Livewire\Component;
use Livewire\WithPagination;

class FuelTypesCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshFuelTypes' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteModel($fuelTypeId)
    {
        ReferentielsFuelType::find($fuelTypeId)->delete();
    }

    public function render()
    {
        $fuelTypes = ReferentielsFuelType::where('nom', 'like', '%' . $this->search . '%')
            ->paginate(6);

        return view('components.admin.fuel-type.fuel-types-catalog', ['fuelTypes' => $fuelTypes]);
    }
}
