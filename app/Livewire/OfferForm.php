<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OfferForm extends Component
{
    public $carId;
    public $proposedPrice;

    protected $rules = [
        'proposedPrice' => 'required|numeric|min:1',
    ];

    public function submit()
    {
        $this->validate();

        // Créer l'offre
        $offer = Offer::create([
            'proposed_price' => $this->proposedPrice,
            'status' => 0, // Statut initial
            'user_id' => Auth::id(),
            'car_id' => $this->carId,
        ]);

        // Trouver ou créer la conversation entre l'acheteur et le vendeur
        $car = $offer->car;
        $vendeur_id = $car->user_id;
        $acheteur_id = Auth::id();

        $conversation = Conversation::where(function ($query) use ($acheteur_id, $vendeur_id) {
            $query->where('user_id_sender', $acheteur_id)
                ->where('user_id_receiver', $vendeur_id);
        })->orWhere(function ($query) use ($acheteur_id, $vendeur_id) {
            $query->where('user_id_sender', $vendeur_id)
                ->where('user_id_receiver', $acheteur_id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_id_sender' => $acheteur_id,
                'user_id_receiver' => $vendeur_id,
            ]);
        }

        // Envoyer l'offre comme message dans le chat du vendeur
        Chat::create([
            'content' => "Nouvelle offre de " . Auth::user()->name . " : " . $this->proposedPrice . "€",
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'offer_id' => $offer->id,
        ]);

        // Fermer le formulaire
        $this->dispatch('closeOfferModal');

        // Rediriger vers la page de chat
        return redirect()->route('chat.index', ['conversationId' => $conversation->id]);
    }

    public function render()
    {
        return view('components.offer-form');
    }
}
