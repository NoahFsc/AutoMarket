<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarsEquipment;
use App\Models\Document;
use App\Models\Equipment;
use App\Models\RefCritAir;
use App\Models\RefFuelType;
use App\Models\RefGearbox;
use App\Models\RefNbDoor;
use App\Models\RefVehiculeType;
use App\Models\Bid;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
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
            'type_of_car_id' => 'required|exists:referentiels_vehicule_type,id',
            'car_year' => 'required|integer|min:1900|max:2022',
            'mileage' => 'required|integer|min:0',
            'consommation' => 'required|integer|min:0',
            'nb_door_id' => 'required|exists:referentiels_nb_doors,id',
            'provenance' => 'required|string',
            'puissance_fiscale' => 'required|integer|min:0',
            'puissance_din' => 'required|integer|min:0',
            'boite_vitesse_id' => 'required|exists:referentiels_gearbox_type,id',
            'carburant_id' => 'required|exists:referentiels_fuel_type,id',
            'crit_air_id' => 'required|exists:referentiels_crit_air,id',
            'co2_emission' => 'required|numeric|min:0',
            'model_id' => 'required|exists:car_models,id',
            'status_ct' => 'required|string|in:À Jour,À Faire',
            'equipment_id' => 'nullable|array',
            'equipment_id.*' => 'exists:equipments,id',
        ]);

        // Convertir 'À Jour' en 1 et 'À Faire' en 0
        $validated['status_ct'] = $validated['status_ct'] === 'À Jour' ? 1 : 0;

        $request->session()->put('create-ad-step1', $validated);

        return redirect()->route('vendre.step2');
    }

    public function showStep2()
    {
        $uploadedImages = session('uploaded_images', []);
        $uploadedDocuments = session('uploaded_documents', []);

        return view('vendre.create-ad_step2', compact('uploadedImages', 'uploadedDocuments'));
    }

    public function doStep2(Request $request)
    {
        $validated = $request->validate([
            'carte_grise' => 'nullable|mimes:pdf|max:2048',
            'fiche_technique' => 'nullable|mimes:pdf|max:2048',
            'controle_technique' => 'nullable|mimes:pdf|max:2048',
            'divers' => 'nullable|mimes:pdf|max:2048',
            'media.*' => 'nullable|mimes:jpeg,png,jpg,mp4,mp3|max:2048',
        ]);

        $uploadedImages = session('uploaded_images', []);
        $uploadedDocuments = session('uploaded_documents', []);

        // Stocker les fichiers PDF temporairement
        $pdfFiles = ['carte_grise', 'fiche_technique', 'controle_technique', 'divers'];
        foreach ($pdfFiles as $pdfFile) {
            if ($request->hasFile($pdfFile)) {
                $path = $request->file($pdfFile)->store('create_ad_temp', 'public');
                $uploadedDocuments[] = [
                    'path' => $path,
                    'type' => 'pdf',
                ];
            }
        }

        // Stocker les fichiers média temporairement
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('create_ad_temp', 'public');
                $uploadedImages[] = $path;

                $documentType = $file->getClientMimeType();
                if (str_contains($documentType, 'image')) {
                    $type = 'image';
                } elseif (str_contains($documentType, 'video')) {
                    $type = 'video';
                } else {
                    $type = 'audio';
                }

                $uploadedDocuments[] = [
                    'path' => $path,
                    'type' => $type,
                ];
            }
        }

        $request->session()->put('uploaded_images', $uploadedImages);
        $request->session()->put('uploaded_documents', $uploadedDocuments);
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

        $documentType = $request->file('media')->getClientMimeType();
        if (str_contains($documentType, 'image')) {
            $type = 'image';
        } elseif (str_contains($documentType, 'video')) {
            $type = 'video';
        } else {
            $type = 'audio';
        }

        $uploadedDocuments = session('uploaded_documents', []);
        $uploadedDocuments[] = [
            'path' => $path,
            'type' => $type,
        ];
        session(['uploaded_documents' => $uploadedDocuments]);

        return response()->json(['path' => $path]);
    }

    public function uploadPDF(Request $request)
    {
        $validated = $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('pdf')->store('create_ad_temp', 'public');

        $uploadedDocuments = session('uploaded_documents', []);
        $uploadedDocuments[] = [
            'path' => $path,
            'type' => 'pdf',
        ];
        session(['uploaded_documents' => $uploadedDocuments]);

        return response()->json(['path' => $path]);
    }

    public function showStep3()
    {
        return view('vendre.create-ad_step3');
    }

    public function doStep3(Request $request)
    {
        $validated = $request->validate([
            'type_annonce' => 'required|in:0,1',
            'prix_vente' => 'required|numeric',
            'commentaire_vendeur' => 'nullable|string',
        ]);

        // Récupérer les données des étapes précédentes depuis la session
        $step1Data = $request->session()->get('create-ad-step1');
        $step2Data = $request->session()->get('create-ad-step2');
        $uploadedDocuments = $request->session()->get('uploaded_documents', []);

        // Créer la voiture
        $car = Car::create([
            'type_of_car_id' => $step1Data['type_of_car_id'],
            'car_year' => $step1Data['car_year'],
            'mileage' => $step1Data['mileage'],
            'consommation' => $step1Data['consommation'],
            'nb_door_id' => $step1Data['nb_door_id'],
            'provenance' => $step1Data['provenance'],
            'puissance_fiscale' => $step1Data['puissance_fiscale'],
            'puissance_din' => $step1Data['puissance_din'],
            'boite_vitesse_id' => $step1Data['boite_vitesse_id'],
            'carburant_id' => $step1Data['carburant_id'],
            'crit_air_id' => $step1Data['crit_air_id'],
            'co2_emission' => $step1Data['co2_emission'],
            'model_id' => $step1Data['model_id'],
            'status_ct' => $step1Data['status_ct'],
            'selling_price' => $validated['prix_vente'],
            'commentaire_vendeur' => $validated['commentaire_vendeur'],
            'user_id' => Auth::id(),
            'vente_enchere' => $validated['type_annonce'], // Ajouter vente_enchere
        ]);

        // Associer les équipements à la voiture
        if (!empty($step1Data['equipment_id'])) {
            foreach ($step1Data['equipment_id'] as $equipmentId) {
                CarsEquipment::create([
                    'car_id' => $car->id,
                    'equipment_id' => $equipmentId,
                ]);
            }
        }

        // Déplacer les fichiers du dossier temporaire vers le dossier définitif et créer les enregistrements en base de données
        foreach ($uploadedDocuments as $document) {
            $oldPath = $document['path'];
            $newPath = str_replace('create_ad_temp', 'document_content', $oldPath);
            Storage::disk('public')->move($oldPath, $newPath);

            Document::create([
                'car_id' => $car->id,
                'document_type' => $document['type'],
                'document_content' => $newPath,
            ]);
        }

        // Créer une enchère ou une offre selon le type d'annonce
        if ($validated['type_annonce'] == 1) {
            Bid::create([
                'proposed_price' => $validated['prix_vente'],
                'status' => 1, // Vente aux enchères
                'user_id' => Auth::id(),
                'car_id' => $car->id,
            ]);
        } else {
            Offer::create([
                'proposed_price' => $validated['prix_vente'],
                'status' => 0, // Vente directe
                'user_id' => Auth::id(),
                'car_id' => $car->id,
            ]);
        }

        // Supprimer les données de la session
        $request->session()->forget(['create-ad-step1', 'create-ad-step2', 'uploaded_images', 'uploaded_documents']);

        return redirect()->route('vendre.index');
    }
}
