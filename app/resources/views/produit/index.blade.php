@extends('layout')

@section('titre', __('Home'))

@section('contenu')

<div class="mx-8 bg-background md:mx-0" x-data="{ showEquipments: false, showCarousel: false, currentPhoto: 0, photos: [
    @foreach($car->documents as $document)
        @if($document->document_type == 'image')
            { src: '{{ asset('storage/' . $document->document_content) }}', alt: __('CarImage') },
        @endif
    @endforeach 
    ]}">
    
    <div>
        <div x-data="photoCarousel()" class="max-w-5xl mx-auto">
            <!-- Conteneur principal -->
            <div class="flex flex-col md:flex-row">
                <!-- Informations sur le véhicule -->
                <div class="w-full md:w-2/3">
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
                    <div class="relative hidden w-full mt-4 space-x-1 md:w-full md:flex md:flex-row md:space-x-1">
                        @php
                            $photoCount = $car->documents->where('document_type', 'image')->count();
                        @endphp
                        @foreach($car->documents as $index => $document)
                            @if($document->document_type == 'image')
                                @if($photoCount == 1)
                                    <div class="w-full h-[350px]">
                                        <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="{{ __('CarImage') }}" class="object-cover w-full h-full rounded-lg">
                                    </div>
                                @elseif($photoCount == 2)
                                    <div class="w-1/2 h-[350px]">
                                        <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="{{ __('CarImage') }}" class="object-cover w-full h-full rounded-lg">
                                    </div>
                                @else
                                    @if($index == 0)
                                        <div class="w-1/2 h-[350px]">
                                            <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="{{ __('CarImage') }}" class="object-cover w-full h-full rounded-lg">
                                        </div>
                                    @elseif($index == 1 || $index == 2)
                                        @if($index == 1)
                                            <div class="flex flex-col w-1/2 space-y-1">
                                        @endif
                                        <div class="relative w-full h-[175px]">
                                            <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="{{ __('CarImage') }}" class="object-cover w-full h-full rounded-lg">
                                            @if($index == 2)
                                                <button @click="showCarousel = true" class="absolute bottom-0 right-0 px-4 py-2 mb-4 mr-4 text-sm text-white bg-black bg-opacity-50 rounded-lg">
                                                    {{ __('SeePhotos') }}
                                                </button>
                                            @endif
                                        </div>
                                        @if($index == 2)
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </div>

                    <!-- Carousel en plein écran -->
                    <div x-cloak x-show="showCarousel" @click.away="showCarousel = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75">
                        <div class="relative w-3/4 h-3/4">
                            <button @click="showCarousel = false" class="absolute top-0 right-0 z-50 px-4 py-2 mt-4 mr-4 text-sm text-white bg-black bg-opacity-50 rounded-lg">{{ __('Close') }}</button>
                            <template x-for="(photo, index) in photos" :key="index">
                                <img x-show="currentPhoto === index" class="absolute inset-0 object-cover w-full h-full" :src="photo.src" :alt="photo.alt">
                            </template>
                            <button @click="currentPhoto = (currentPhoto > 0) ? currentPhoto - 1 : photos.length - 1" class="absolute left-0 z-40 px-4 py-2 text-white bg-black bg-opacity-50 rounded-full top-1/2">‹</button>
                            <button @click="currentPhoto = (currentPhoto < photos.length - 1) ? currentPhoto + 1 : 0" class="absolute right-0 z-40 px-4 py-2 text-white bg-black bg-opacity-50 rounded-full top-1/2">›</button>
                            <!-- Liste des petites images en dessous -->
                            <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center p-4 space-x-2 bg-black bg-opacity-50">
                                <button @click="currentPhoto = (currentPhoto > 0) ? currentPhoto - 1 : photos.length - 1" class="px-2 py-1 text-white bg-black bg-opacity-50 rounded-full">‹</button>
                                <template x-for="(photo, index) in visiblePhotos()" :key="index">
                                    <img @click="currentPhoto = (currentPhoto + index) % photos.length" :src="photo.src" :alt="photo.alt" class="object-cover w-16 h-16 rounded-lg cursor-pointer">
                                </template>
                                <button @click="currentPhoto = (currentPhoto < photos.length - 1) ? currentPhoto + 1 : 0" class="px-2 py-1 text-white bg-black bg-opacity-50 rounded-full">›</button>
                            </div>
                        </div>
                    </div>

                    <!-- Informations sur le modèle -->
                    <div class="flex flex-col mt-6">
                        <div class="flex justify-between">
                            <div>
                                <h1 class="text-2xl font-bold">{{$car->carModel->brand->brand_name ." ". $car->carModel->model_name}}</h1>
                                <p class="mt-1 text-sm text-default/50">
                                    @php
                                        use Carbon\Carbon;
                                        $createdAt = Carbon::parse($car->created_at);
                                        if ($createdAt->isToday()) {
                                            echo sprintf("Aujourd'hui à %s", $createdAt->format('H\hi'));
                                        } elseif ($createdAt->isYesterday()) {
                                            echo sprintf("Hier à %s", $createdAt->format('H\hi'));
                                        } else {
                                            echo sprintf("Il y a %d jours", $createdAt->diffInDays());
                                        }
                                    @endphp
                                </p>
                            </div>
                            <p class="text-2xl font-medium">{{number_format($car->selling_price)}}€</p>
                        </div>
                    </div>

                    <!-- Informations générales -->
                    <div class="w-full mt-4 space-y-4 md:space-y-0 md:flex md:space-x-4">
                        <!-- Informations générales -->
                        <div class="p-4 rounded-lg bg-input md:w-3/5">
                            <div class="relative">
                                <div class="flex items-center space-x-2">
                                    <i class="fa-light fa-circle-info"></i>
                                    <h2 class="text-lg font-medium md:text-xl">{{ __('GeneralInformation') }}</h2>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-input-border opacity-50"></div>
                            </div>
                            <ul class="mt-2 space-y-2">
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('VehicleYear') }}</span>
                                    <span class="text-xs">{{$car->car_year}}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('Mileage') }}</span>
                                    <span class="text-xs">{{number_format($car->mileage)}} km</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('GearboxType') }}</span>
                                    <span class="text-xs">{{$car->boite_vitesse}}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('NumberOfDoors') }}</span>
                                    <span class="text-xs">{{$car->nbDoor->nb_doors}}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('Origin') }}</span>
                                    <span class="text-xs">{{$car->provenance}}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Moteur -->
                        <div class="p-4 rounded-lg bg-input md:w-2/5">
                            <div class="relative">
                                <div class="flex items-center space-x-2">
                                    <i class="fa-light fa-engine"></i>
                                    <h2 class="text-lg font-medium md:text-xl">{{ __('Engine') }}</h2>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-input-border opacity-50"></div>
                            </div>
                            <ul class="mt-2 space-y-2">
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('EngineType') }}</span>
                                    <span class="text-xs">{{$car->fuelType->nom}}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('FiscalPower') }}</span>
                                    <span class="text-xs">{{number_format($car->puissance_fiscale)}} ch</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('DINPower') }}</span>
                                    <span class="text-xs">{{number_format($car->puissance_din)}} km</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Impact et Équipement -->
                    <div class="w-full mt-4 space-y-4 md:space-y-0 md:flex md:space-x-4">
                        <!-- Impact -->
                        <div class="p-4 rounded-lg bg-input md:w-2/5">
                            <div class="relative">
                                <div class="flex items-center space-x-2">
                                    <i class="fa-regular fa-leaf"></i>
                                    <h2 class="text-lg font-medium md:text-xl">{{ __('Impact') }}</h2>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-input-border opacity-50"></div>
                            </div>
                            <ul class="mt-2 space-y-2">
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('Consumption') }}</span>
                                    <span class="text-xs">{{$car->consommation}}kWh/100km</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('CritAir') }}</span>
                                    <span class="text-xs">{{$car->critAir->nom}}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-xs opacity-50">{{ __('Emission') }}</span>
                                    <span class="text-xs">{{$car->co2_emission}}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Équipement -->
                        <div class="p-4 rounded-lg bg-input md:w-3/5">
                            <div class="relative">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-regular fa-briefcase"></i>
                                        <h2 class="text-lg font-medium md:text-xl">{{ __('Equipment') }}</h2>
                                    </div>
                                    <a href="#" @click.prevent="showEquipments = true" class="text-xs text-blue-500 hover:underline">{{ __('SeeMore') }}</a>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-input-border opacity-50"></div>
                            </div>
                            <div class="hidden md:grid md:gap-4 md:mt-4 md:grid-cols-4">
                                @foreach ($car->equipments->take(8) as $equipment)
                                    <div class="flex items-center justify-center">
                                        <span class="text-xs text-center">{{ $equipment->equipment->equipment_name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Interface modale pour afficher tous les équipements -->
                    <div x-cloak x-show="showEquipments" @click.away="showEquipments = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75">
                        <div class="relative w-3/4 p-4 rounded-lg bg-input">
                            <button @click="showEquipments = false" class="absolute top-0 right-0 px-4 py-2 mt-4 mr-4 text-sm text-white bg-black bg-opacity-50 rounded-lg">{{ __('Close') }}</button>
                            <h2 class="mb-4 text-lg font-medium md:text-xl">{{ __('Equipment') }}</h2>
                            <div class="grid gap-4 md:grid-cols-2">
                                @foreach ($car->equipments as $equipment)
                                    <div class="flex items-center justify-center">
                                        <span class="text-xs text-center">{{ $equipment->equipment->equipment_name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Commentaire du vendeur -->
                    <div class="w-full p-4 mt-4 rounded-lg bg-input">
                        <div class="relative">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <i class="fa-regular fa-message"></i>
                                    <h2 class="text-lg font-medium">{{ __('SellerComment') }}</h2>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-0.5 bg-input-border opacity-50"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-700">
                                {{$car->commentaire_vendeur}}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Section vendeur pour l'interface PC -->
                <div id="seller-section" class="flex-col hidden p-4 md:flex md:w-1/6 md:fixed md:right-40 md:top-40 md:h-full md:items-center">
                    <div class="flex items-center gap-4">
                        <img src="{{ $car->user->profile_picture ? asset('storage/' . $car->user->profile_picture) : asset('assets/default_pfp.png') }}" alt="{{ __('CarImage') }}" class="w-16 h-16 rounded-full">
                        <div>
                            <h2 class="text-lg font-semibold">{{$car->user->first_name ." ". $car->user->last_name}}</h2>
                            <p class="text-sm text-default/50">★★★★★</p>
                        </div>
                    </div>
                    <livewire:offer-form :carId="$car->id" />
                    <p class="mt-2 text-center text-default/50">{{ __('Or') }}</p>
                    <div class="flex flex-col w-full gap-2 mt-2">
                        <a href="{{ route('chat.start', $car->user->id) }}" class="px-4 py-2 text-white !bg-primary rounded-lg text-center">{{ __('SendMessage') }}</a>
                        <!-- Bouton "Voir le numéro de téléphone" -->
                        @auth
                        <div x-data="{ showPhone: false }">
                            <button @click="showPhone = !showPhone" class="w-full px-4 py-2 border-2 rounded-lg text-primary border-primary border-opacity-20">
                                {{ __('SeePhoneNumber') }}
                            </button>
                            <div x-cloak x-show="showPhone" x-transition class="flex justify-center w-full mt-2 text-gray-700">
                                {{ $car->user->telephone }}
                            </div>
                        </div>
                        @endauth
                        @guest
                        <a href="{{ route('auth.login') }}" 
                        class="flex items-center justify-center h-12 px-4 py-2 border-2 rounded-lg text-primary border-primary border-opacity-20">
                        {{ __('SeePhoneNumber') }}
                        </a>
                        @endguest                    
                    </div>

                    @if ($car->vente_enchere)
                    {{-- Temps restant --}}
                    <livewire:remaining-time :car="$car" />
                    @endif
                </div>

                <!-- Section vendeur pour l'interface téléphone -->
                <div id="seller-section-phone" class="fixed left-0 right-0 flex items-center justify-center p-4 bg-input bottom-16 md:hidden">
                    <div class="flex w-full space-x-2">
                        <button class="flex-1 px-4 py-2 text-white text-xs !bg-primary rounded-lg">{{ __('Offer') }}</button>
                        <a href="{{ route('chat.start', $car->user->id) }}" class="flex-1 px-4 py-2 text-white text-xs !bg-primary rounded-lg text-center">{{ __('SendMessage') }}</a>
                        <!-- Bouton "Voir le numéro de téléphone" -->
                        @auth
                        <div x-data="{ showPhone: false }" class="flex-1">
                            <button @click="copyToClipboard('{{ $car->user->telephone }}')" class="w-full px-4 py-2 text-xs border-2 rounded-lg text-primary border-primary border-opacity-20">
                                {{ __('PhoneNumber') }}
                            </button>
                        </div>
                        @endauth
                        @guest
                        <a href="{{ route('auth.login') }}" 
                        class="flex items-center justify-center w-full h-12 px-4 py-2 text-xs border-2 rounded-lg text-primary border-primary border-opacity-20">
                        {{ __('PhoneNumber') }}
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <!-- Section Recommandation -->
        <div class="w-3/4 mx-auto mt-4">
            <div class="flex justify-between">
                <h2 class="mb-4 text-2xl font-bold">{{ __('YourRecommendations') }}</h2>
            </div>
            <div class="grid gap-4 grid-cols-auto-fit-card">
                @foreach ($recommandations as $car)
                @livewire('selling-card', ['car' => $car])
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function photoCarousel() {
        return {
            photos: [
                @foreach($car->documents as $document)
                    @if($document->document_type == 'image')
                        { src: '{{ asset($document->document_content) }}', alt: 'Car Image' },
                    @endif
                @endforeach
            ],
            currentPhoto: 0,
            showCarousel: false,
            visiblePhotos() {
                let start = this.currentPhoto;
                let end = start + 3;
                if (end > this.photos.length) {
                    end = end % this.photos.length;
                    return this.photos.slice(start).concat(this.photos.slice(0, end));
                } else {
                    return this.photos.slice(start, end);
                }
            }
        };
    }

    function copyToClipboard(text) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Numéro de téléphone copié dans le presse-papier');
            }, function(err) {
                console.error('Erreur lors de la copie du texte : ', err);
            });
        } else {
            // Méthode de secours pour les navigateurs qui ne supportent pas l'API Clipboard
            var textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                alert('Numéro de téléphone copié dans le presse-papier');
            } catch (err) {
                console.error('Erreur lors de la copie du texte : ', err);
            }
            document.body.removeChild(textArea);
        }
    }
</script>
@endsection
