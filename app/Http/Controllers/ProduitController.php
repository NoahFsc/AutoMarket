<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index($id)
    {
        $car = Car::findOrFail($id);
        return view('produit.index', compact('car'));
    }
}
