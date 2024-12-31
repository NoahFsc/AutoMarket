@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex justify-center text-3xl font-semibold text-gray-800 mb-10">Poster une annonce</div>
    <div class="mb-6 relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full h-1 bg-info-500 mt-8 mr-8 ml-20"></div>
        </div>
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col items-center">
                <div class="text-gray-700 mb-2">Informations Générales</div>
                <div class="w-8 h-8 bg-info-500 rounded-full flex items-center justify-center">
                    <i class="fa-regular fa-check text-white"></i>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-gray-500 mb-2">Documents</div>
                <div class="w-8 h-8 bg-info-500 rounded-full flex items-center justify-center">
                    <i class="fa-regular fa-check text-white"></i>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-gray-500 mb-2">Confirmation</div>
                <div class="w-8 h-8 border-4 bg-white border-info-500 rounded-full"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step3') }}" method="POST">
        @csrf
        <div>
            <div class="text-2xl font-semibold text-gray-800 mb-6">Finalisation</div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-500 font-medium mb-2">Type d'annonce</label>
                    <select
                        class="w-full border-gray-300 text-gray-500 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                        <option value="" disabled selected>Sélectionner un type d'annonce</option>
                        <option>Vente directe</option>
                        <option>Vente aux enchères</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-500 font-medium mb-2">Prix de vente</label>
                    <input type="number"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                        placeholder="Entrez un prix">
                </div>
            </div>
        </div>
        <div>
            <div class="text-2xl font-semibold text-gray-800 mt-6 mb-6">Commentaire du vendeur</div>
            <textarea name="comment" id="comment"
                class="w-full h-32 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"></textarea>
        </div>
        <div class="flex justify-center mt-8 gap-4">
            <button type="button" class="px-6 py-2 border border-gray-300 text-gray-500 rounded-md hover:bg-gray-100"
                onclick="window.history.back()">Étape précédente</button>
            <button type="submit" class="px-6 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-400">Confirmer
                la création</button>
        </div>
    </form>
</div>

@endsection