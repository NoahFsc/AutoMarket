<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class VendreController extends Controller
{
    public function index()
    {
        return view('vendre.index');
    }

    public function showStep1()
    {
        return view('vendre.create-ad');
    }

    public function doStep1(Request $request)
    {
        // Logique pour traiter les données de la première étape
    }

    public function showStep2()
    {
        return view('vendre.step2');
    }

    public function doStep2(Request $request)
    {
        // Logique pour traiter les données de la deuxième étape
    }

    public function showStep3()
    {
        return view('vendre.step3');
    }

    public function doStep3(Request $request)
    {
        // Logique pour traiter les données de la troisième étape
    }
}
