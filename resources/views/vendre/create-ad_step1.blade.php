@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-5xl">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('vendre.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Retour à la page
            précédente</a>
    </div>
    <h1 class="text-xl font-semibold text-gray-800 mb-6">Poster une annonce</h1>

    <!-- Progress bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-8 h-8 flex items-center justify-center bg-blue-500 text-white rounded-full">1</div>
                <span class="ml-2 text-gray-700">Informations Générales</span>
            </div>
            <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full">2</div>
                <span class="ml-2 text-gray-500">Documents</span>
            </div>
            <div class="flex-1 h-1 bg-gray-200 mx-4"></div>
            <div class="flex items-center">
                <div class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-500 rounded-full">3</div>
                <span class="ml-2 text-gray-500">Confirmation</span>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left column -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Marque</label>
                <select
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">
                    <option>Sélectionner une marque</option>
                </select>

                <label class="block text-gray-700 font-medium mt-4 mb-2">Modèle</label>
                <select
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">
                    <option>Sélectionner un modèle</option>
                </select>

                <label class="block text-gray-700 font-medium mt-4 mb-2">Type de Véhicule</label>
                <select
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">
                    <option>Sélectionner un type</option>
                </select>

                <label class="block text-gray-700 font-medium mt-4 mb-2">Contrôle Technique</label>
                <select
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">
                    <option>Sélectionner un état</option>
                </select>
            </div>

            <!-- Right column -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Année</label>
                <input type="number"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">

                <label class="block text-gray-700 font-medium mt-4 mb-2">Provenance</label>
                <input type="text"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">

                <label class="block text-gray-700 font-medium mt-4 mb-2">Kilométrage</label>
                <input type="number"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">

                <label class="block text-gray-700 font-medium mt-4 mb-2">Nombres de portes</label>
                <input type="number"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">
            </div>
        </div>

        <!-- Equipment -->
        <div class="mt-8">
            <label class="block text-gray-700 font-medium mb-2">Équipement</label>
            <select
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300">
                <option>Choisir un équipement</option>
            </select>
            <div class="flex gap-2 mt-2">
                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Texte</span>
                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Texte</span>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between mt-8">
            <button type="button" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Étape
                précédente</button>
            <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Étape
                suivante</button>
        </div>
    </form>
</div>

@endsection