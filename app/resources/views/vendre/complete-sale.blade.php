@extends('layout')

@section('titre', 'Compléter la vente')

@section('contenu')
<div class="flex flex-col w-1/3 mx-auto">
    <a href="{{ route('chat.index') }}" class="flex items-center gap-2 text-default/50 hover:text-default/80">
        <i class="fa-solid fa-arrow-left"></i> Retour à la page précédente
    </a>
    <span class="my-3 text-3xl font-medium">Confirmer la vente du véhicule</span>

    {{-- Récapitulatif --}}
    <div class="flex gap-4 p-3 mb-4 rounded-lg bg-input">
        <img src="{{ $offer->car->imageDocument->document_content }}" alt="Image de couverture" class="object-cover w-1/2 rounded-lg">
        <div class="flex flex-col">
            <h2 class="text-2xl font-medium">Récapitulatif</h2>
            <p class="text-sm opacity-50">Annonce</p>
            <p class="text-lg">{{ $offer->car->carModel->brand->brand_name }} {{ $offer->car->carModel->model_name }}</p>
            <p class="text-sm opacity-50">Prix initial</p>
            <p class="text-lg">{{ number_format($offer->car->selling_price, 2) }} €</p>
            <p class="text-sm opacity-50">Acheteur potentiel</p>
            <p class="text-lg">{{ $offer->buyer->first_name }} {{ $offer->buyer->last_name }}</p>
        </div>
    </div>

    {{-- Formulaire --}}
    <form action="{{ route('vendre.complete-sale', ['offerId' => $offer->id]) }}" method="POST">
        @csrf

        <!-- Prix de vente -->
        <div class="mb-4">
            <label for="proposed_price" class="text-sm font-medium text-default/50">Prix de vente</label>
            <input type="text" name="proposed_price" value="{{ $offer->proposed_price }}" class="w-full rounded-md border-input-border bg-input focus:border-primary focus:ring-primary" readonly>
        </div>

        <div class="flex gap-2 mb-4">
            <!-- Type de livraison -->
            <div class="w-full">
                <label for="delivery_type" class="text-sm font-medium text-default/50">Type de livraison</label>
                <select name="delivery_type" id="delivery_type" class="w-full rounded-md border-input-border bg-input focus:border-primary focus:ring-primary">
                    <option value="Remise en main propre">Remise en main propre</option>
                    <option value="Livraison à domicile">Livraison à domicile</option>
                </select>
            </div>
            <!-- Date de l'échange -->
            <div class="w-full">
                <label for="exchange_date" class="text-sm font-medium text-default/50">Date de l'échange</label>
                <input type="date" name="exchange_date" id="exchange_date" class="w-full rounded-md border-input-border bg-input focus:border-primary focus:ring-primary">
            </div>
        </div>
        <!-- Bouton de confirmation -->
        <div class="flex justify-end gap-4">
            <button type="submit" class="px-8 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80">Confirmer la vente</button>
        </div>
    </form>
</div>
@endsection
