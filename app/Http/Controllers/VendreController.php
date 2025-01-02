<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\RefCritAir;
use App\Models\RefFuelType;
use App\Models\RefGearbox;
use App\Models\RefNbDoor;
use App\Models\RefVehiculeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $equipments = Equipment::all();

        return view('vendre.create-ad', compact('critairs', 'nbdoors', 'fueltypes', 'gearboxes', 'vehiculeTypes', 'equipments'));
    }

    public function doStep1(Request $request)
    {
        $validated = $request->validate([
            'model_id' => 'required',
            'type_of_car' => 'required|string',

        ]);

        $request->session()->put('create-ad-step1', $validated);

        return redirect()->route('vendre.step2');
    }

    public function showStep2()
    {
        $uploadedImages = session('uploaded_images', []);

        return view('vendre.create-ad_step2', compact('uploadedImages'));
    }

    public function doStep2(Request $request)
    {
        $validated = $request->validate([
            'media.*' => 'mimes:jpeg,png,jpg,mp4,mp3|max:2048',
        ]);

        $uploadedImages = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('create_ad_temp', 'public');
                $uploadedImages[] = $path;
            }
        }
        $request->session()->put('uploaded_images', $uploadedImages);

        $request->session()->put('create-ad-step2', $validated);

        return redirect()->route('vendre.step3');
    }

    public function uploadMedia(Request $request)
    {
        $validated = $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,mp4,mp3|max:2048',
        ]);

        $path = $request->file('media')->store('create_ad_temp', 'public');

        $uploadedImages = session('uploaded_images', []);
        $uploadedImages[] = $path;
        session(['uploaded_images' => $uploadedImages]);

        return response()->json(['path' => $path]);
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
        $request->session()->forget(['create-ad-step1', 'create-ad-step2', 'uploaded_images']);

        // Vider le dossier create_ad_temp
        $this->clearTempDirectory();

        return redirect()->route('vendre.index');
    }

    private function clearTempDirectory()
    {
        $files = Storage::disk('public')->allFiles('create_ad_temp');
        Storage::disk('public')->delete($files);
    }
}
