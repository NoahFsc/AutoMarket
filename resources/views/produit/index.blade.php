@extends('layout')

@section('titre', 'Accueil')

@section('contenu')

<body class="bg-gray-100">
    <div class="max-w-md mx-auto mt-5 overflow-hidden">
        <!-- Image et informations principales -->
        <div class="relative w-5/6 mx-auto">
            <img class="object-cover w-full h-64 rounded-lg" src="{{ asset('assets/teslay.jpg') }}" alt="Tesla Model Y">
            <div class="flex flex-col p-4">
                <div class="flex justify-between w-full">
                    <div>
                        <h1 class="text-2xl">Tesla Model Y</h1>
                        <p class="text-xs opacity-50">Aujourd'hui à 10h34</p>
                    </div>
                    <p class="text-2xl font-medium">64 380€</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Informations générales -->
    <div class="w-5/6 p-4 mx-auto mt-4 bg-white rounded-lg shadow-lg">
        <div class="relative">
            <div class="flex items-center space-x-2">
                <i class="fa-light fa-circle-info"></i>
                <h2 class="text-lg font-medium">Informations générales</h2>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
        </div>
            <ul class="mt-2 space-y-2">
                <li class="flex justify-between">
                <span class="text-xs opacity-50">Année du véhicule</span>
                <span class="text-xs">2020</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Kilométrage</span>
                <span class="text-xs">15 265</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Type de boîte</span>
                <span class="text-xs">Manuelle</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Nombre de portes</span>
                <span class="text-xs">5</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Provenance</span>
                <span class="text-xs">France</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Certificat technique</span>
                <span class="text-xs">Révisé</span>
            </li>
        </ul>
    </div>

    <!-- Informations moteur -->
    <div class="w-5/6 p-4 mx-auto mt-4 bg-white rounded-lg shadow-lg">
        <div class="relative">
            <div class="flex items-center space-x-2">
                <i class="fa-regular fa-car"></i>
                <h2 class="text-lg font-medium">Moteur</h2>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
        </div>
        <ul class="mt-2 space-y-2">
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Énergie</span>
                <span class="text-xs">Électrique</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Puissance Fiscale</span>
                <span class="text-xs">8 CV</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Puissance DIN</span>
                <span class="text-xs">Manuelle</span>
            </li>
        </ul>
    </div>

    <!-- Informations moteur -->
    <div class="w-5/6 p-4 mx-auto mt-4 bg-white rounded-lg shadow-lg">
        <div class="relative">
            <div class="flex items-center space-x-2">
                <i class="fa-regular fa-cloud"></i>
                <h2 class="text-lg font-medium">Impact</h2>
            </div>
            <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
        </div>
        <ul class="mt-2 space-y-2">
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Consommation</span>
                <span class="text-xs">17kWh/100km</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Crit'air</span>
                <span class="text-xs">8 CV</span>
            </li>
            <li class="flex justify-between">
                <span class="text-xs opacity-50">Émission</span>
                <span class="text-xs">5</span>
            </li>
        </ul>
    </div>

</div>

@endsection