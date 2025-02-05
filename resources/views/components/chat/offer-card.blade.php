<div wire:poll.1000ms="updateCard" class="text-black min-w-80">
    <div class="flex flex-col gap-2 p-2 bg-white rounded-lg">
        <div class="flex gap-2">
            <img src="{{ $offer->car->imageDocument->document_content }}" alt="Car Image" class="w-32 h-24 rounded-lg">
            <div>
                <h3 class="text-lg font-medium">{{ $offer->car->carModel->brand->brand_name }} {{ $offer->car->carModel->model_name }}</h3>
                <p class="text-sm"><span class="opacity-50">Offre - </span> {{ $offer->proposed_price }} €</p>
            </div>
        </div>
        @if($offer->accepted_declined === 0)

            {{-- Vue vendeur --}}
            @if(Auth::id() === $offer->car->user_id)
                <div class="flex gap-2">
                    <button wire:click="acceptOffer({{ $offer->id }})" class="w-full px-4 py-2 text-white rounded-lg bg-primary hover:bg-opacity-80">Accepter</button>
                    <button wire:click="declineOffer({{ $offer->id }})" class="w-full px-4 py-2 text-white rounded-lg bg-error hover:bg-opacity-90">Refuser</button>
                </div>
            
            {{-- Vue acheteur --}}
            @else
                <p class="opacity-50">En attente de réponse du vendeur</p>
            @endif

        {{-- En cas d'offre acceptée --}}
        @elseif($offer->accepted_declined === 1)

            {{-- Vue vendeur --}}
            @if(Auth::id() === $offer->car->user_id)
                <div class="flex flex-col gap-2"> 
                    @if ($offer->status === 0)
                    <p class="flex items-center gap-2 text-validation"><i class="fa-solid fa-check"></i>Offre acceptée, complétion en attente</p>
                    <button wire:click="completeSale({{ $offer->id }})" class="flex justify-center w-full px-4 py-2 text-white rounded-lg bg-primary hover:bg-opacity-80">Compléter la vente</button>
                    @else
                    <p class="flex items-center gap-2 text-validation"><i class="fa-solid fa-check"></i>Offre acceptée, vente complétée</p>
                    @endif
                </div>
                    {{-- Vue acheteur --}}
            @else
                <p class="flex items-center gap-2 text-validation"><i class="fa-solid fa-check"></i>Offre acceptée, consultez votre historique d'achat</p>
            @endif

        {{-- En cas d'offre refusée --}}
        @else
            <p class="flex items-center gap-2 text-error"><i class="fa-regular fa-xmark"></i>Offre refusée</p>
        @endif
    </div>
</div>