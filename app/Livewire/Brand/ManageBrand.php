<?php

namespace App\Livewire\Brand;

use App\Models\Brand;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ManageBrand extends Component
{
    public $brand_id;
    public $brand_name;

    protected $rules = [
        'brand_name' => 'required|string|max:255',
    ];

    protected $listeners = ['openManageBrandModal' => 'openModal'];

    public function openModal($brand_id = null)
    {
        if ($brand_id) {
            $brand = Brand::findOrFail($brand_id);
            $this->brand_id = $brand->id;
            $this->brand_name = $brand->brand_name;
        } else {
            $this->reset(['brand_id', 'brand_name']);
        }
    }

    public function saveBrand()
    {
        $this->validate();

        if ($this->brand_id) {
            $brand = Brand::findOrFail($this->brand_id);
            $brand->update([
                'brand_name' => $this->brand_name,
            ]);
            session()->flash('status', 'Marque modifiée avec succès.');
        } else {
            Brand::create([
                'brand_name' => $this->brand_name,
            ]);
            session()->flash('status', 'Marque ajoutée avec succès.');
        }

        // Réinitialiser les champs du formulaire
        $this->reset(['brand_id', 'brand_name']);

        $this->dispatch('close-manage-brand-modal');
        $this->dispatch('refreshBrands');
    }

    public function render()
    {
        return view('components.admin.brand.manage-brand');
    }
}
