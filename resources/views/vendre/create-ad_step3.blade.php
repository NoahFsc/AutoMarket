@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex justify-center mb-10 text-3xl font-semibold text-gray-800">Poster une annonce</div>
    <div class="relative mb-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full h-1 mt-8 ml-20 mr-8 bg-info"></div>
        </div>
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col items-center">
                <div class="mb-2 text-gray-700">Informations Générales</div>
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-info">
                    <i class="text-white fa-regular fa-check"></i>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-gray-500">Documents</div>
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-info">
                    <i class="text-white fa-regular fa-check"></i>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-gray-500">Confirmation</div>
                <div class="w-8 h-8 bg-white border-4 rounded-full border-info"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step3') }}" method="POST">
        @csrf
        <div>
            <div class="mb-6 text-2xl font-semibold text-gray-800">Finalisation</div>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 font-medium text-gray-500">Type d'annonce</label>
                    <select name="type_annonce"
                        class="w-full text-gray-500 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                        <option value="" disabled selected>Sélectionner un type d'annonce</option>
                        <option value="0">Vente directe</option>
                        <option value="1">Vente aux enchères</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-medium text-gray-500">Prix de vente</label>
                    <input type="number" name="prix_vente"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                        placeholder="Entrez un prix">
                </div>
            </div>
        </div>
        <div>
            <div class="mt-6 mb-6 text-2xl font-semibold text-gray-800">Commentaire du vendeur</div>
            <textarea name="commentaire_vendeur"
                class="w-full h-32 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"></textarea>
        </div>
        <div class="flex justify-center gap-4 mt-8">
            <button type="button" class="px-6 py-2 text-gray-500 border border-gray-300 rounded-md hover:bg-gray-100"
                onclick="window.history.back()">Étape précédente</button>
            <button type="submit" class="px-6 py-2 text-white rounded-md bg-primary hover:bg-opacity-80">Confirmer
                la création</button>
        </div>
    </form>
</div>

@endsection