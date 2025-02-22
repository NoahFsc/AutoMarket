<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarsEquipment;
use App\Models\Document;
use App\Models\Equipment;
use App\Models\Offer;
use App\Models\Order;
use App\Models\ReferentielsCritAir;
use App\Models\ReferentielsFuelType;
use App\Models\ReferentielsGearBox;
use App\Models\ReferentielsNbDoor;
use App\Models\ReferentielsVehiculeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendreController extends Controller
{
    public function index()
    {
        return view('vendre.index');
    }

    public function showStep1()
    {
        $critairs = ReferentielsCritAir::all();
        $nbdoors = ReferentielsNbDoor::all();
        $fueltypes = ReferentielsFuelType::all();
        $gearboxes = ReferentielsGearBox::all();
        $vehiculeTypes = ReferentielsVehiculeType::all();
        $equipments = Equipment::all();

        return view('vendre.create-ad', compact('critairs', 'nbdoors', 'fueltypes', 'gearboxes', 'vehiculeTypes', 'equipments'));
    }

    public function doStep1(Request $request)
    {
        $validated = $request->validate([
            'type_of_car_id' => 'required|exists:referentiels_vehicule_type,id',
            'car_year' => 'required|integer|min:1900|max:2025',
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
            'equipments' => 'nullable|array',
            'equipments.*' => 'exists:equipments,id',
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

        $validated['user_id'] = Auth::id();

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
            'minimum_price' => $validated['prix_vente'],
            'commentaire_vendeur' => $validated['commentaire_vendeur'],
            'vente_enchere' => $validated['type_annonce'],
            'user_id' => $validated['user_id'],
        ]);

        // Associer les équipements à la voiture
        if (! empty($step1Data['equipments'])) {
            foreach ($step1Data['equipments'] as $equipmentId) {
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

        // Supprimer les données de la session
        $request->session()->forget(['create-ad-step1', 'create-ad-step2', 'uploaded_images', 'uploaded_documents']);

        return redirect()->route('vendre.index');
    }

    public function showCompleteSaleForm($offerId)
    {
        $offer = Offer::findOrFail($offerId);

        return view('vendre.complete-sale', compact('offer'));
    }

    public function completeSale(Request $request, $offerId)
    {
        // 1. Vérifier les champs du formulaire
        $validated = $request->validate([
            'delivery_type' => 'required|string|in:Remise en main propre,Livraison à domicile',
            'exchange_date' => 'required|date',
        ]);

        // Convertir 'Remise en main propre' en 0 et 'Livraison à domicile' en 1
        $validated['delivery_type'] = $validated['delivery_type'] === 'Remise en main propre' ? 0 : 1;

        // 2. Ajouter un nouvel enregistrement dans la table d'historique d'achat
        $offer = Offer::findOrFail($offerId);
        Order::create([
            'delivery_status' => 0,
            'user_id' => $offer->buyer->id,
            'car_id' => $offer->car->id,
            'order_date' => now(),
            'delivery_type' => $validated['delivery_type'],
        ]);

        // 3. Mettre à jour le statut de l'offre dans Offers (status = 1)
        $offer->update(['status' => 1]);

        // 4. Mettre à jour le statut de l'annonce dans Cars (status = 1)
        $offer->car->update(['status' => 1]);

        // 5. Mettre à jour le selling_price de l'annonce au prix de vente de l'offre (proposed_price)
        $offer->car->update(['selling_price' => $offer->proposed_price]);

        // 6. Renvoyer vers la page de chat (route chat.index)
        return redirect()->route('chat.index');
    }

    public function showHA()
    {
        return view('user.historiqueachat');
    }

    public function showhaview($orderId)
    {
        $order = Order::with(['car.carModel.brand', 'car.user'])->findOrFail($orderId);
        return view('user.ha-view', compact('order'));
    }

    public function markAsReceived($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['delivery_status' => 1]);

        return redirect()->route('user.ha-view', ['orderId' => $orderId])->with('success', 'Commande marquée comme reçue.');
    }
}
