<?php

namespace App\Livewire\Type;

use App\Models\ReferentielsVehiculeType;
use Livewire\Component;

class ManageType extends Component
{
    public $type_of_car_id;
    public $segment;
    public $nom;

    protected $rules = [
        'nom' => 'required|string|max:255',
        'segment' => 'required|string|max:255',
    ];

    protected $listeners = ['openManageTypeModal' => 'openModal'];

    public function openModal($type_of_car_id = null)
    {
        if ($type_of_car_id) {
            $type = ReferentielsVehiculeType::findOrFail($type_of_car_id);
            $this->type_of_car_id = $type->id;
            $this->nom = $type->nom;
            $this->segment = $type->segment;
        } else {
            $this->reset(['type_of_car_id', 'nom', 'segment']);
        }
    }

    public function saveType()
    {
        $this->validate();

        if ($this->type_of_car_id) {
            $type = ReferentielsVehiculeType::findOrFail($this->type_of_car_id);
            $type->update([
                'nom' => $this->nom,
                'segment' => $this->segment,
            ]);
            session()->flash('status', 'Type de véhicule modifié avec succès.');
        } else {
            ReferentielsVehiculeType::create([
                'segment' => $this->segment,
                'nom' => $this->nom,
            ]);
            session()->flash('status', 'Type de véhicule ajouté avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['type_of_car_id', 'nom', 'segment']);

        $this->dispatch('close-manage-type-modal');
        $this->dispatch('refreshTypes');
    }

    public function render()
    {
        return view('components.admin.type.manage-type');
    }
}
