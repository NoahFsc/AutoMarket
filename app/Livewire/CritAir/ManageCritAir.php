<?php

namespace App\Livewire\CritAir;

use App\Models\ReferentielsCritAir;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCritAir extends Component
{
    use WithFileUploads;

    public $crit_air_id;
    public $nom;
    public $image;

    protected $rules = [
        'nom' => 'required|string|max:255',
        'image' => 'required|image|max:1024',
    ];

    protected $listeners = ['openManageCritAirModal' => 'openModal'];

    public function openModal($crit_air_id = null)
    {
        if ($crit_air_id) {
            $critair = ReferentielsCritAir::findOrFail($crit_air_id);
            $this->crit_air_id = $critair->id;
            $this->nom = $critair->nom;
            $this->image = $critair->image;
        } else {
            $this->reset(['crit_air_id', 'nom', 'image']);
        }
    }

    public function saveCritair()
    {
        $this->validate();

        $imagePath = $this->image->store('public/images');

        if ($this->crit_air_id) {
            $critair = ReferentielsCritAir::findOrFail($this->crit_air_id);
            $critair->update([
                'nom' => $this->nom,
                'image' => $imagePath,
            ]);
            session()->flash('status', 'Crit\'Air modifié avec succès.');
        } else {
            ReferentielsCritAir::create([
                'nom' => $this->nom,
                'image' => $imagePath,
            ]);
            session()->flash('status', 'Crit\'Air ajouté avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['crit_air_id', 'nom', 'image']);

        $this->dispatch('close-manage-critair-modal');
        $this->dispatch('refreshCritAir');
    }

    public function render()
    {
        return view('components.admin.critair.manage-critair');
    }
}
