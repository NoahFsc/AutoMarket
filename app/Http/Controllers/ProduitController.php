<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function vente($id)
    {
        $car = Car::findOrFail($id);
        return view('produit.produit-vente', compact('car'));
    }

    public function enchere($id)
    {
        $car = Car::findOrFail($id);
        return view('produit.produit-enchere', compact('car'));
    }
}
