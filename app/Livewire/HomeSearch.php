<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\CarModel;
use Livewire\Component;
use Carbon\Carbon;

class HomeSearch extends Component
{
    public array $carModels = [];
    public array $brands = [];

    public $marqueSelectionnee = "";
    public $modeleSelectionne = "";

    public ?int $kmMax = null;
    public string $codePostal = "";

    public function mount()
    {
        $this->brands = Brand::all()->toArray();
        $this->carModels = CarModel::all()->toArray();
    }

    public function updatedMarqueSelectionnee($marqueId)
    {
        $this->modeleSelectionne = ''; // Tu remets à 0 le modèle choisi
        $this->carModels = CarModel::where('brand_id', $marqueId)->get()->toArray();
    }

    public function sendFilters()
    {
        session()->put('filters', [
            'marque' => $this->marqueSelectionnee,
            'modele' => $this->modeleSelectionne,
            'kmMax' => $this->kmMax,
            'codePostal' => $this->codePostal,
        ]);

        return redirect()->route('acheter.index');
    }

    public function render()
    {
        return view('components.home-search');
    }
}
