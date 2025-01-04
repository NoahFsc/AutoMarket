<?php

namespace App\Livewire\CritAir;

use App\Models\ReferentielsCritAir;
use Livewire\Component;
use Livewire\WithPagination;

class CritAirCatalog extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['refreshCritAir' => '$refresh'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function deleteCritair($critairId)
    {
        ReferentielsCritAir::find($critairId)->delete();
    }

    public function render()
    {
        $critairs = ReferentielsCritAir::where('nom', 'like', '%' . $this->search . '%')
            ->paginate(6);

        return view('components.admin.critair.critair-catalog', ['critairs' => $critairs]);
    }
}
