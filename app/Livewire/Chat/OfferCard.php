<?php

namespace App\Livewire\Chat;

use App\Models\Offer;
use Livewire\Component;

class OfferCard extends Component
{
    public $offer;

    public function mount(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function updateCard()
    {
        $this->offer = Offer::find($this->offer->id);
    }

    public function acceptOffer($offerId)
    {
        $offer = Offer::find($offerId);
        $offer->update(['accepted_declined' => 1]);

        $this->updateCard();
    }

    public function declineOffer($offerId)
    {
        $offer = Offer::find($offerId);
        $offer->update(['accepted_declined' => -1]);

        $this->updateCard();
    }

    public function completeSale($offerId)
    {
        return redirect()->route('vendre.complete-sale', ['offerId' => $offerId]);
    }

    public function render()
    {
        return view('components.chat.offer-card');
    }
}
