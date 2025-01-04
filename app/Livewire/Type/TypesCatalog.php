<?php

namespace App\Livewire\Type;

use App\Models\ReferentielsVehiculeType;
use Livewire\Component;
use Livewire\WithPagination;

class TypesCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshTypes' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteType($typeId)
    {
        ReferentielsVehiculeType::find($typeId)->delete();
    }

    public function render()
    {
        $types = ReferentielsVehiculeType::where('nom', 'like', '%' . $this->search . '%')
            ->orWhere('segment', 'like', '%' . $this->search . '%')
            ->paginate(6);

        return view('components.admin.type.types-catalog', ['vehicleTypes' => $types]);
    }
}
