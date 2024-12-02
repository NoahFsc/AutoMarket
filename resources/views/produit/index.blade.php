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
    <div class="w-5/6 mx-auto mt-4 bg-white">
        <h2 class="text-lg font-medium">Informations générales</h2>
        <ul class="mt-2 space-y-2">
            <li class="flex justify-between">
                <span>Année du véhicule</span>
                <span>2020</span>
            </li>
            <li class="flex justify-between">
                <span>Kilométrage</span>
                <span>15 265</span>
            </li>
            <li class="flex justify-between">
                <span>Type de boîte</span>
                <span>Manuelle</span>
            </li>
            <li class="flex justify-between">
                <span>Nombre de portes</span>
                <span>5</span>
            </li>
            <li class="flex justify-between">
                <span>Provenance</span>
                <span>France</span>
            </li>
            <li class="flex justify-between">
                <span>Certificat technique</span>
                <span>Révisé</span>
            </li>
        </ul>
    </div>

</div>

@endsection