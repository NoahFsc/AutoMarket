<?php

namespace App\Livewire\NbDoor;

use App\Models\ReferentielsNbDoor;
use Livewire\Component;
use Livewire\WithPagination;

class NbDoorsCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshNbDoors' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteNbDoor($nbDoorId)
    {
        ReferentielsNbDoor::find($nbDoorId)->delete();
    }

    public function render()
    {
        $nbDoors = ReferentielsNbDoor::where('nb_doors', 'like', '%'.$this->search.'%')
            ->paginate(6);

        return view('components.admin.nb-door.nb-doors-catalog', ['nbDoors' => $nbDoors]);
    }
}
