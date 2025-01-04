<?php

namespace App\Livewire\NbDoor;

use App\Models\ReferentielsNbDoor;
use Livewire\Component;

class ManageNbDoor extends Component
{
    public $nb_door_id;
    public $nb_doors;

    protected $rules = [
        'nb_doors' => 'required|integer|min:1|max:5',
    ];

    protected $listeners = ['openManageNbDoorModal' => 'openModal'];

    public function openModal($nb_door_id = null)
    {
        if ($nb_door_id) {
            $nbdoor = ReferentielsNbDoor::findOrFail($nb_door_id);
            $this->nb_door_id = $nbdoor->id;
            $this->nb_doors = $nbdoor->nb_doors;
        } else {
            $this->reset(['nb_door_id', 'nb_doors']);
        }
    }

    public function saveNbDoor()
    {
        $this->validate();

        if ($this->nb_door_id) {
            $nbdoor = ReferentielsNbDoor::findOrFail($this->nb_door_id);
            $nbdoor->update([
                'nb_doors' => $this->nb_doors,
            ]);
            session()->flash('status', 'Nombre de portes modifié avec succès.');
        } else {
            ReferentielsNbDoor::create([
                'nb_doors' => $this->nb_doors,
            ]);
            session()->flash('status', 'Nombre de portes ajouté avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['nb_door_id', 'nb_doors']);

        $this->dispatch('close-manage-nb-door-modal');
        $this->dispatch('refreshNbDoors');
    }

    public function render()
    {
        return view('components.admin.nb-door.manage-nb-door');
    }
}
