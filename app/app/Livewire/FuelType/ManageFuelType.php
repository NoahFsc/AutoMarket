<?php

namespace App\Livewire\FuelType;

use App\Models\ReferentielsFuelType;
use Livewire\Component;

class ManageFuelType extends Component
{
    public $carburant_id;

    public $nom;

    protected $rules = [
        'nom' => 'required|string|max:255',
    ];

    protected $listeners = ['openManageFuelTypeModal' => 'openModal'];

    public function openModal($carburant_id = null)
    {
        if ($carburant_id) {
            $carburant = ReferentielsFuelType::findOrFail($carburant_id);
            $this->carburant_id = $carburant->id;
            $this->nom = $carburant->nom;
        } else {
            $this->reset(['carburant_id', 'nom']);
        }
    }

    public function saveFuelType()
    {
        $this->validate();

        if ($this->carburant_id) {
            $carburant = ReferentielsFuelType::findOrFail($this->carburant_id);
            $carburant->update([
                'nom' => $this->nom,
            ]);
            session()->flash('status', 'Type de carburant modifié avec succès.');
        } else {
            ReferentielsFuelType::create([
                'nom' => $this->nom,
            ]);
            session()->flash('status', 'Type de carburant ajouté avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['carburant_id', 'nom']);

        $this->dispatch('close-manage-fuel-type-modal');
        $this->dispatch('refreshFuelTypes');
    }

    public function render()
    {
        return view('components.admin.fuel-type.manage-fuel-type');
    }
}
