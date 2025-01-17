<?php

namespace App\Livewire\Gearbox;

use App\Models\ReferentielsGearBox;
use Livewire\Component;

class ManageGearbox extends Component
{
    public $gearbox_id;

    public $nom;

    protected $rules = [
        'nom' => 'required|string|max:255',
    ];

    protected $listeners = ['openManageGearboxModal' => 'openModal'];

    public function openModal($gearbox_id = null)
    {
        if ($gearbox_id) {
            $gearbox = ReferentielsGearBox::findOrFail($gearbox_id);
            $this->gearbox_id = $gearbox->id;
            $this->nom = $gearbox->nom;
        } else {
            $this->reset(['gearbox_id', 'nom']);
        }
    }

    public function saveGearbox()
    {
        $this->validate();

        if ($this->gearbox_id) {
            $gearbox = ReferentielsGearBox::findOrFail($this->gearbox_id);
            $gearbox->update([
                'nom' => $this->nom,
            ]);
            session()->flash('status', 'Boîte de vitesses modifiée avec succès.');
        } else {
            ReferentielsGearBox::create([
                'nom' => $this->nom,
            ]);
            session()->flash('status', 'Boîte de vitesses ajoutée avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['gearbox_id', 'nom']);

        $this->dispatch('close-manage-gearbox-modal');
        $this->dispatch('refreshGearboxes');
    }

    public function render()
    {
        return view('components.admin.gearbox.manage-gearbox');
    }
}
