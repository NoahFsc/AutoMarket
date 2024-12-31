@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex justify-center text-3xl font-semibold text-gray-800 mb-10">Poster une annonce</div>
    <div class="mb-6 relative">
        <div class="absolute inset-0 flex items-center">
            <div class="relative w-full h-1 mt-8 mr-8 ml-20">
                <div class="absolute left-0 top-0 h-full bg-info-500" style="width: 50%;"></div>
                <div class="absolute right-0 top-0 h-full bg-white" style="width: 50%;"></div>
            </div>
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
                <div class="w-8 h-8 border-4 bg-white border-info-500 rounded-full"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-gray-500 mb-2">Confirmation</div>
                <div class="w-8 h-8 bg-white rounded-full"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step2') }}" method="POST">
        @csrf
        <div class="text-2xl font-semibold text-gray-800 mb-6">Documents du véhicule</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-500 font-medium mb-2">Carte Grise</label>
                <div class="flex items-center border border-gray-300 rounded-md px-4 py-2">
                    <i class="fa-light fa-upload text-gray-500 mr-3"></i>
                    <label
                        class="w-full text-gray-500 focus:outline-none focus:ring focus:ring-blue-300 cursor-pointer">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="carte_grise" accept="application/pdf" class="hidden">
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-gray-500 font-medium mb-2">Fiche Technique</label>
                <div class="flex items-center border border-gray-300 rounded-md px-4 py-2">
                    <i class="fa-light fa-upload text-gray-500 mr-3"></i>
                    <label
                        class="w-full text-gray-500 focus:outline-none focus:ring focus:ring-blue-300 cursor-pointer">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="fiche_technique" accept="application/pdf" class="hidden">
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-gray-500 font-medium mb-2">Contrôle Technique</label>
                <div class="flex items-center border border-gray-300 rounded-md px-4 py-2">
                    <i class="fa-light fa-upload text-gray-500 mr-3"></i>
                    <label
                        class="w-full text-gray-500 focus:outline-none focus:ring focus:ring-blue-300 cursor-pointer">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="controle_technique" accept="application/pdf" class="hidden">
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-gray-500 font-medium mb-2">Divers</label>
                <div class="flex items-center border border-gray-300 rounded-md px-4 py-2">
                    <i class="fa-light fa-upload text-gray-500 mr-3"></i>
                    <label
                        class="w-full text-gray-500 focus:outline-none focus:ring focus:ring-blue-300 cursor-pointer">
                        <span class="text-gray-500">Déposez vos fichiers au format pdf</span>
                        <input type="file" name="divers" accept="application/pdf" class="hidden">
                    </label>
                </div>
            </div>
        </div>
        <div class="text-2xl font-semibold text-gray-800 mt-6 mb-6">Photos et vidéos</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center border border-gray-300 rounded-md px-4 py-2">
                <i class="fa-light fa-upload text-gray-500 mr-3"></i>
                <label class="w-full text-gray-500 focus:outline-none focus:ring focus:ring-blue-300 cursor-pointer">
                    <span class="text-gray-500">Déposez vos images et vos vidéos</span>
                    <input type="file" name="media" accept="image/jpeg,image/png,image/jpg,video/mp4" class="hidden">
                </label>
            </div>
        </div>
        <div class="flex justify-center mt-8 gap-4">
            <button type="button" class="px-6 py-2 border border-gray-300 text-gray-500 rounded-md hover:bg-gray-100"
                onclick="window.history.back()">Étape précédente</button>
            <button type="submit" class="px-6 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-400">Étape
                suivante</button>
        </div>
    </form>
</div>

@endsection