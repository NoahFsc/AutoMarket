<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\Brand;
use App\Models\CarModel;
use Livewire\WithPagination;

class CarCatalog extends Component
{
    use WithPagination;

    // Champs à filtrer
    public string $postal_code = '';
    public ?int $kilometrage_min = null;
    public ?int $kilometrage_max = null;
    public ?int $price_min = null;
    public ?int $price_max = null;
    public ?int $portes = null;
    public ?int $sieges = null;
    public bool $diesel = false;
    public bool $essence = false;
    public bool $electrique = false;
    public bool $hybride = false;
    public bool $manuelle = false;
    public bool $automatique = false;
    public bool $non_verifie = false;
    public bool $verifie = false;

    public string $search = '';
    public string $sortDirection = '';

    public array $brands = [];
    public string $selectedBrand = '';

    public array $carModels = [];
    public string $selectedCarModel = '';

    public function mount()
    {
        $this->brands = Brand::all()->toArray();
        $this->carModels = CarModel::all()->toArray();
    }

    public function updatedSelectedBrand($brandId)
    {
        $this->selectedCarModel = '';
        $this->carModels = CarModel::where('brand_id', $brandId)->get()->toArray();
    }

    public function toggleSort()
    {
        if ($this->sortDirection === 'asc') {
            $this->sortDirection = 'desc';
        } elseif ($this->sortDirection === 'desc') {
            $this->sortDirection = '';
        } else {
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        // Récupération des voitures mises en vente (pas enchères)
        $requete = Car::where('vente_enchere', 0);

        $filtres = [
            ['selling_price', '>=', $this->price_min],
            ['selling_price', '<=', $this->price_max],
            ['mileage', '>=', $this->kilometrage_min],
            ['mileage', '<=', $this->kilometrage_max],
            ['nb_door', '=', $this->portes],
            ['nb_door', '=', $this->sieges],
        ];

        foreach ($filtres as $filtre) {
            if ($filtre[2] !== null) {
                $requete->where($filtre[0], $filtre[1], $filtre[2]);
            }
        }

        $carburants = [
            'diesel' => $this->diesel,
            'essence' => $this->essence,
            'électrique' => $this->electrique,
            'hybride' => $this->hybride,
        ];

        $boites = [
            'manuelle' => $this->manuelle,
            'automatique' => $this->automatique,
        ];

        $requete->where(function ($q) use ($carburants) {
            foreach ($carburants as $carburant => $valeur) {
                if ($valeur) {
                    $q->orWhere('carburant', $carburant);
                }
            }
        });

        $requete->where(function ($q) use ($boites) {
            foreach ($boites as $boite => $valeur) {
                if ($valeur) {
                    $q->orWhere('boite_vitesse', $boite);
                }
            }
        });

        if ($this->non_verifie) {
            $requete->whereHas('user', function ($q) {
                $q->whereNull('email_verified_at');
            });
        }

        if ($this->verifie) {
            $requete->whereHas('user', function ($q) {
                $q->whereNotNull('email_verified_at');
            });
        }

        if ($this->search) {
            $requete->whereHas('carModel', function ($q) {
                $q->where('model_name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($q) {
                        $q->where('brand_name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->postal_code) {
            $requete->where('postal_code', 'like', substr($this->postal_code, 0, 2) . '%');
        }

        if ($this->selectedBrand) {
            $requete->whereHas('carModel.brand', function ($q) {
                $q->where('id', $this->selectedBrand);
            });
        }

        if ($this->selectedCarModel) {
            $requete->whereHas('carModel', function ($q) {
                $q->where('id', $this->selectedCarModel);
            });
        }

        if ($this->sortDirection) {
            $requete->orderBy('selling_price', $this->sortDirection);
        }

        $cars = $requete->paginate(9);

        return view('components.car-catalog', ['cars' => $cars, 'brands' => $this->brands, 'carModels' => $this->carModels]);
    }
}
