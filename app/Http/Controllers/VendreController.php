<?php

namespace App\Http\Controllers;

use App\Models\RefCritAir;
use App\Models\RefFuelType;
use App\Models\RefGearbox;
use App\Models\RefNbDoor;
use App\Models\RefVehiculeType;
use Illuminate\Http\Request;

class VendreController extends Controller
{
    public function index()
    {
        return view('vendre.index');
    }

    public function showStep1()
    {
        $critairs = RefCritAir::all();
        $nbdoors = RefNbDoor::all();
        $fueltypes = RefFuelType::all();
        $gearboxes = RefGearbox::all();
        $vehiculeTypes = RefVehiculeType::all();

        return view('vendre.create-ad', compact('critairs', 'nbdoors', 'fueltypes', 'gearboxes', 'vehiculeTypes'));
    }

    public function doStep1(Request $request)
    {
        $validated = $request->validate([]);

        $request->session()->put('create-ad-step1', $validated);

        return redirect()->route('vendre.step2');
    }

    public function showStep2()
    {
        return view('vendre.create-ad_step2');
    }

    public function doStep2(Request $request)
    {
        $validated = $request->validate([]);

        $request->session()->put('create-ad-step2', $validated);

        return redirect()->route('vendre.step3');
    }

    public function showStep3()
    {
        return view('vendre.create-ad_step3');
    }

    public function doStep3(Request $request)
    {
        $validated = $request->validate([]);

        // Récupérer les données des étapes précédentes depuis la session
        $step1Data = $request->session()->get('create-ad-step1');
        $step2Data = $request->session()->get('create-ad-step2');

        // Insérer les données dans la base de données
        // Exemple :
        // $ad = new Ad();
        // $ad->fill(array_merge($step1Data, $step2Data, $validated));
        // $ad->save();

        // Supprimer les données de la session
        $request->session()->forget(['create-ad-step1', 'create-ad-step2']);

        return redirect()->route('vendre.index');
    }
}
