<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\CarModel;
use Livewire\Component;

class CreateSearch extends Component
{
    public array $carModels = [];

    public array $brands = [];

    public $marqueSelectionnee = '';

    public $modeleSelectionne = '';

    public function mount()
    {
        $this->brands = Brand::all()->toArray();
        $this->carModels = CarModel::all()->toArray();
    }

    public function updatedMarqueSelectionnee($marqueId)
    {
        $this->modeleSelectionne = ''; // Réinitialise le modèle choisi
        $this->carModels = CarModel::where('brand_id', $marqueId)->get()->toArray();
    }

    public function render()
    {
        return view('components.create-search');
    }
}
