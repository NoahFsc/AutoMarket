<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\ReferentielsCritAir;
use App\Models\ReferentielsFuelType;
use App\Models\ReferentielsNbDoor;
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

    // Champs de sélection de carburant
    public array $carburants = [];
    public array $selectedCarburants = [];

    // Champs de sélection de nombres de portes
    public array $nbDoors = [];
    public array $selectedNbDoors = [];

    // Champs de sélection du crit'air
    public array $critairs = [];
    public array $selectedCritairs = [];

    // Récupération des marques et modèles de voitures au chargement du composant
    public function mount(?int $type = null)
    {
        $this->brands = Brand::all()->toArray();
        $this->carModels = CarModel::all()->toArray();
        $this->carburants = ReferentielsFuelType::all()->toArray();
        $this->nbDoors = ReferentielsNbDoor::all()->toArray();
        $this->critairs = ReferentielsCritAir::all()->toArray();
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
        ];

        // Comparer chaque filtre avec sa valeur
        foreach ($filtres as $filtre) {
            if ($filtre[2] !== null) {
                $requete->where($filtre[0], $filtre[1], $filtre[2]);
            }
        }

        // Filtre carburant
        if (!empty($this->selectedCarburants)) {
            $requete->whereIn('carburant_id', $this->selectedCarburants);
        }

        // Filtre crit_air
        if (!empty($this->selectedCritairs)) {
            $requete->whereIn('crit_air_id', $this->selectedCritairs);
        }

        // Filtre nb_door
        if (!empty($this->selectedNbDoors)) {
            $requete->whereIn('nb_door_id', $this->selectedNbDoors);
        }

        $boites = [
            'manuelle' => $this->manuelle,
            'automatique' => $this->automatique,
        ];

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

        return view('components.car-catalog', [
            'cars' => $cars,
            'brands' => $this->brands,
            'carModels' => $this->carModels,
            'carburants' => $this->carburants,
            'nbDoors' => $this->nbDoors,
            'critairs' => $this->critairs
        ]);
    }
}
