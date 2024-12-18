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

    public ?int $type = null;

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

    // Champs de recherche et de tri
    public string $search = '';
    public string $sortTime = '';
    public string $sortPrice = '';

    // Champs de sélection de marque
    public array $brands = [];
    public string $selectedBrand = '';

    // Champs de sélection de modèle
    public array $carModels = [];
    public string $selectedCarModel = '';

    // Récupération des marques et modèles de voitures au chargement du composant
    public function mount(?int $type = null)
    {
        $this->brands = Brand::all()->toArray();
        $this->carModels = CarModel::all()->toArray();
        $this->type = $type;

        // Récupérer les filtres de la session
        $filters = session()->get('filters', []);

        $this->selectedBrand = $filters['marque'] ?? '';
        $this->selectedCarModel = $filters['modele'] ?? '';
        $this->kilometrage_max = $filters['kmMax'] ?? null;
        $this->postal_code = $filters['codePostal'] ?? '';

        // Supprimer les filtres de la session
        session()->forget('filters');
    }

    // Mise à jour des modèles de voitures en fonction de la marque sélectionnée
    public function updatedSelectedBrand($brandId)
    {
        $this->selectedCarModel = '';
        $this->carModels = CarModel::where('brand_id', $brandId)->get()->toArray();
    }

    // Tri des véhicules par temps restant (pour enchères)
    public function toggleTime()
    {
        if ($this->sortTime === 'asc') {
            $this->sortTime = 'desc';
        } elseif ($this->sortTime === 'desc') {
            $this->sortTime = '';
        } else {
            $this->sortTime = 'asc';
        }
    }

    // Tri des véhicules par prix
    public function togglePrice()
    {
        if ($this->sortPrice === 'asc') {
            $this->sortPrice = 'desc';
        } elseif ($this->sortPrice === 'desc') {
            $this->sortPrice = '';
        } else {
            $this->sortPrice = 'asc';
        }
    }

    public function render()
    {
        // Requête de récupération des voitures
        if ($this->type === 0) {
            $requete = Car::where('vente_enchere', 0);
        } else {
            $requete = Car::where('vente_enchere', 1);
        }

        $filtres = [
            ['selling_price', '>=', $this->price_min],
            ['selling_price', '<=', $this->price_max],
            ['mileage', '>=', $this->kilometrage_min],
            ['mileage', '<=', $this->kilometrage_max],
            ['nb_door', '=', $this->portes],
            ['nb_door', '=', $this->sieges],
        ];

        // Comparer chaque filtre avec sa valeur
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

        // Filtre carburant
        $requete->where(function ($q) use ($carburants) {
            foreach ($carburants as $carburant => $valeur) {
                if ($valeur) {
                    $q->orWhere('carburant', $carburant);
                }
            }
        });

        // Filtre boîte de vitesse
        $requete->where(function ($q) use ($boites) {
            foreach ($boites as $boite => $valeur) {
                if ($valeur) {
                    $q->orWhere('boite_vitesse', $boite);
                }
            }
        });

        // Filtre utilisateurs non vérifiés
        if ($this->non_verifie) {
            $requete->whereHas('user', function ($q) {
                $q->whereNull('email_verified_at');
            });
        }

        // Filtre utilisateurs vérifiés
        if ($this->verifie) {
            $requete->whereHas('user', function ($q) {
                $q->whereNotNull('email_verified_at');
            });
        }

        // Filtre code postal
        if ($this->postal_code) {
            $requete->where('postal_code', 'like', substr($this->postal_code, 0, 2) . '%');
        }

        // Filtre marque
        if ($this->selectedBrand) {
            $requete->whereHas('carModel.brand', function ($q) {
                $q->where('id', $this->selectedBrand);
            });
        }

        // Filtre modèle
        if ($this->selectedCarModel) {
            $requete->whereHas('carModel', function ($q) {
                $q->where('id', $this->selectedCarModel);
            });
        }

        // Tri par temps restant
        if ($this->sortTime) {
            $requete->orderBy('deadline', $this->sortTime);
        }

        // Tri par prix
        if ($this->sortPrice) {
            $requete->orderBy('selling_price', $this->sortPrice);
        }

        // Recherche par nom de modèle ou de marque
        if ($this->search) {
            $requete->whereHas('carModel', function ($q) {
                $q->where('model_name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('brand', function ($q) {
                        $q->where('brand_name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Récupération des voitures paginées (9 par page)
        $cars = $requete->paginate(9);

        return view('components.car-catalog', ['cars' => $cars, 'brands' => $this->brands, 'carModels' => $this->carModels]);
    }
}
