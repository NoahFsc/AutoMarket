<?php

namespace App\Http\Controllers;

use App\Models\Car;

class ProduitController extends Controller
{
    public function index($id)
    {
        $car = Car::findOrFail($id);
        $recommandations = Car::where('type_of_car_id', $car->type_of_car_id)
                  ->where('id', '!=', $car->id)
                  ->limit(4)
                  ->get();

        return view('produit.index', compact('car', 'recommandations'));
    }
}
