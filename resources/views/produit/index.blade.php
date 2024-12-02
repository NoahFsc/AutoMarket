@extends('layout')

@section('titre', 'Accueil')

@section('contenu')

<body class="bg-gray-100">
    <div x-data="photoCarousel()" class="max-w-5xl mx-auto mt-10">
        <!-- Conteneur principal -->
        <div class="flex flex-col md:flex-row">
            <!-- Image principale pour téléphone -->
            <div class="w-full h-64 md:hidden">
                <div class="relative w-full h-full">
                    <template x-for="(photo, index) in photos" :key="index">
                        <img x-show="currentPhoto === index" class="absolute inset-0 object-cover w-full h-full rounded-lg" :src="photo.src" :alt="photo.alt">
                    </template>
                    <!-- Boutons de navigation pour le carousel -->
                    <button @click="currentPhoto = (currentPhoto > 0) ? currentPhoto - 1 : photos.length - 1" class="absolute left-0 px-2 py-1 text-white transform -translate-y-1/2 bg-black bg-opacity-50 rounded-full top-1/2">‹</button>
                    <button @click="currentPhoto = (currentPhoto < photos.length - 1) ? currentPhoto + 1 : 0" class="absolute right-0 px-2 py-1 text-white transform -translate-y-1/2 bg-black bg-opacity-50 rounded-full top-1/2">›</button>
                </div>
            </div>
            <!-- Images secondaires pour l'interface PC -->
            <div class="relative flex w-full mt-4 space-x-4">
                <!-- Première image prenant 50% de l'espace -->
                <div class="w-[400px] h-[350px]">
                    <img class="object-cover w-full h-full rounded-lg" src="{{ asset('assets/teslay.jpg') }}" alt="Tesla Model Y">
                </div>
                <!-- Deux autres images en colonne prenant chacune 50% de l'espace restant -->
                <div class="flex flex-col justify-between w-[400px] space-y-1 relative">
                    <img class="object-cover w-full h-[173px] rounded-lg" src="{{ asset('assets/teslay.jpg') }}" alt="Tesla Model Y">
                    <div class="relative">
                        <img class="object-cover w-full h-[173px] rounded-lg" src="{{ asset('assets/teslay.jpg') }}" alt="Tesla Model Y">
                        <!-- Bouton pour voir plus de photos -->
                        <div class="absolute bottom-0 right-0 hidden mb-4 mr-4 md:block">
                            <button @click="showAllPhotos = !showAllPhotos" class="relative px-4 py-2 text-sm text-white bg-black bg-opacity-50 rounded-lg">
                                <span class="relative z-10 opacity-100" x-show="!showAllPhotos">Voir les 14 photos</span>
                                <span class="relative z-10 opacity-100" x-show="showAllPhotos">Voir moins</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Informations sur le modèle -->
        <div class="flex flex-col mt-6">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Tesla Model Y</h1>
                    <p class="mt-1 text-sm text-gray-500">Aujourd'hui à 17h23</p>
                </div>
                <p class="text-2xl font-medium">64 380€</p>
            </div>
        </div>
    </div>
        <div class="left-0">
    
            <!-- Informations générales -->
            <div class="w-5/6 mx-auto mt-4 space-y-4 md:space-y-0 md:flex md:space-x-4">
                <!-- Informations générales -->
                <div class="p-4 bg-white rounded-lg md:w-3/5">
                    <div class="relative">
                        <div class="flex items-center space-x-2">
                            <i class="fa-light fa-circle-info"></i>
                            <h2 class="text-lg font-medium md:text-xl">Informations générales</h2>
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
                    </ul>
                </div>
        
                <!-- Moteur -->
                <div class="p-4 bg-white rounded-lg md:w-2/5">
                    <div class="relative">
                        <div class="flex items-center space-x-2">
                            <i class="fa-light fa-engine"></i>
                            <h2 class="text-lg font-medium md:text-xl">Moteur</h2>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
                    </div>
                    <ul class="mt-2 space-y-2">
                        <li class="flex justify-between">
                            <span class="text-xs opacity-50">Type de moteur</span>
                            <span class="text-xs">Électrique</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-xs opacity-50">Puissance fiscale</span>
                            <span class="text-xs">450 ch</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-xs opacity-50">Puissance DIN</span>
                            <span class="text-xs">500 km</span>
                        </li>
                    </ul>
                </div>
            </div>
        
            <!-- Impact et Équipement -->
            <div class="w-5/6 mx-auto mt-4 space-y-4 md:space-y-0 md:flex md:space-x-4">
            <!-- Impact -->
                <div class="p-4 bg-white rounded-lg md:w-2/5">
                    <div class="relative">
                        <div class="flex items-center space-x-2">
                            <i class="fa-regular fa-leaf"></i>
                            <h2 class="text-lg font-medium md:text-xl">Impact</h2>
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
        
            <!-- Équipement -->
            <div class="p-4 bg-white rounded-lg md:w-3/5">
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fa-regular fa-briefcase"></i>
                            <h2 class="text-lg font-medium md:text-xl">Équipement</h2>
                        </div>
                        <a href="#" class="text-xs text-blue-500 hover:underline">Voir plus</a>
                    </div>
                    <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
                </div>
            </div>
        </div>
        
            <div class="w-5/6 p-4 mx-auto mt-4 bg-white rounded-lg ">
                <div class="relative">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <i class="fa-regular fa-message"></i>
                            <h2 class="text-lg font-medium">Commentaire du vendeur</h2>
                        </div>
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm text-gray-700 opacity-50">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi temp.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function photoCarousel() {
        return {
            photos: [
                { src: '{{ asset('assets/teslay.jpg') }}', alt: 'Tesla Model Y' },
                { src: '{{ asset('assets/logo.png') }}', alt: 'Tesla Model Y' },
                { src: '{{ asset('assets/teslay.jpg') }}', alt: 'Tesla Model Y' },
                { src: '{{ asset('assets/teslay.jpg') }}', alt: 'Tesla Model Y' },
            ],
            currentPhoto: 0,
            showAllPhotos: false,
        };
    }
</script>

@endsection