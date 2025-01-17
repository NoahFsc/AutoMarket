<?php

namespace App\Livewire\Gearbox;

use App\Models\ReferentielsGearBox;
use Livewire\Component;
use Livewire\WithPagination;

class GearboxesCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshGearboxes' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteGearbox($gearboxId)
    {
        ReferentielsGearBox::find($gearboxId)->delete();
    }

    public function render()
    {
        $gearboxes = ReferentielsGearBox::where('nom', 'like', '%'.$this->search.'%')
            ->paginate(6);

        return view('components.admin.gearbox.gearboxes-catalog', ['gearboxes' => $gearboxes]);
    }
}
