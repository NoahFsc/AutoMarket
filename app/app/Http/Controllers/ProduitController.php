<?php

namespace App\Http\Controllers;

use App\Models\Car;

class ProduitController extends Controller
{
    public function vente($id)
    {
        $car = Car::findOrFail($id);
        $recommandations = Car::where('type_of_car_id', $car->type_of_car_id)
                  ->where('id', '!=', $car->id)
                  ->limit(4)
                  ->get();

        return view('produit.produit-vente', compact('car', 'recommandations'));
    }

    public function enchere($id)
    {
        $car = Car::findOrFail($id);

        return view('produit.produit-enchere', compact('car'));
    }
}
