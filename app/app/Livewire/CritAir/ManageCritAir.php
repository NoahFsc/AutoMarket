<?php

namespace App\Livewire\CritAir;

use App\Models\ReferentielsCritAir;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCritAir extends Component
{
    use WithFileUploads;

    public $crit_air_id;

    public $nom;

    public $image;

    public $currentImage;

    protected $rules = [
        'nom' => 'required|string|max:255',
        'image' => 'nullable|image|max:1024',
    ];

    protected $listeners = ['openManageCritAirModal' => 'openModal'];

    public function openModal($crit_air_id = null)
    {
        if ($crit_air_id) {
            $critair = ReferentielsCritAir::findOrFail($crit_air_id);
            $this->crit_air_id = $critair->id;
            $this->nom = $critair->nom;
            $this->currentImage = Storage::url($critair->image);
            $this->image = null;
        } else {
            $this->reset(['crit_air_id', 'nom', 'image', 'currentImage']);
        }
    }

    public function saveCritair()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('images', 'public') : $this->currentImage;

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
        $this->reset(['crit_air_id', 'nom', 'image', 'currentImage']);

        $this->dispatch('close-manage-critair-modal');
        $this->dispatch('refreshCritAir');
    }

    public function render()
    {
        return view('components.admin.critair.manage-critair');
    }
}
