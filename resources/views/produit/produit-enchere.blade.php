@extends('layout')

@section('titre', 'Accueil')

@section('contenu')

<div class="mx-8 bg-gray-100 md:mx-0">
    <div class="max-w-5xl mx-auto mt-10">
        <!-- Conteneur principal -->
        <div class="flex flex-col md:flex-row">
            <!-- Informations sur le véhicule -->
            <div class="w-full md:w-2/3">
                <!-- Image principale pour téléphone -->
                <div class="w-full h-64 md:hidden">
                    <div class="relative w-full h-full">
                        <div id="phone-carousel">
                            @foreach($car->documents as $index => $document)
                                @if($document->document_type == 'image')
                                    <img src="{{ asset('storage/' . $document->document_content) }}" alt="Car Image" class="absolute inset-0 object-cover w-full h-full rounded-lg phone-carousel-image" style="display: none;">
                                @endif
                            @endforeach
                        </div>
                        <!-- Boutons de navigation pour le carousel -->
                        <button id="phone-carousel-prev" class="absolute left-0 px-2 py-1 text-white transform -translate-y-1/2 bg-black bg-opacity-50 rounded-full top-1/2">‹</button>
                        <button id="phone-carousel-next" class="absolute right-0 px-2 py-1 text-white transform -translate-y-1/2 bg-black bg-opacity-50 rounded-full top-1/2">›</button>
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
                                    <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="Car Image" class="object-cover w-full h-full rounded-lg">
                                </div>
                            @elseif($photoCount == 2)
                                <div class="w-1/2 h-[350px]">
                                    <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="Car Image" class="object-cover w-full h-full rounded-lg">
                                </div>
                            @else
                                @if($index == 0)
                                    <div class="w-1/2 h-[350px]">
                                        <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="Car Image" class="object-cover w-full h-full rounded-lg">
                                    </div>
                                @elseif($index == 1 || $index == 2)
                                    @if($index == 1)
                                        <div class="flex flex-col w-1/2 space-y-1">
                                    @endif
                                    <div class="relative w-full h-[175px]">
                                        <img src="{{ $document->document_content ? asset('storage/' . $document->document_content) : asset('assets/default_pfp.png') }}" alt="Car Image" class="object-cover w-full h-full rounded-lg">
                                        @if($index == 2)
                                            <button class="absolute bottom-0 right-0 px-4 py-2 mb-4 mr-4 text-sm text-white bg-black bg-opacity-50 rounded-lg carousel-open">
                                                Voir les {{ $photoCount }} photos
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
                <div class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black bg-opacity-75 carousel" style="display: none;">
                    <div class="relative w-3/4 h-3/4">
                        <button class="absolute top-0 right-0 z-50 px-4 py-2 mt-4 mr-4 text-sm text-white bg-black bg-opacity-50 rounded-lg carousel-close">Fermer</button>
                        @foreach($car->documents as $index => $document)
                            @if($document->document_type == 'image')
                                <img src="{{ asset('storage/' . $document->document_content) }}" alt="Car Image" class="absolute inset-0 object-cover w-full h-full" style="display: none;">
                            @endif
                        @endforeach
                        <button data-direction="prev" class="absolute left-0 z-40 px-4 py-2 text-white bg-black bg-opacity-50 rounded-full carousel-button top-1/2">‹</button>
                        <button data-direction="next" class="absolute right-0 z-40 px-4 py-2 text-white bg-black bg-opacity-50 rounded-full carousel-button top-1/2">›</button>
                    </div>
                    <div class="flex mt-4 space-x-2">
                        @foreach($car->documents as $index => $document)
                            @if($document->document_type == 'image')
                                <img src="{{ asset('storage/' . $document->document_content) }}" alt="Car Image" class="object-cover w-24 h-24 rounded-lg preview-image" data-index="{{ $index }}">
                            @endif
                        @endforeach
                    </div>
                </div>
                
                <!-- Informations sur le modèle -->
                <div class="flex flex-col mt-6">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text-2xl font-bold">{{$car->carModel->brand->brand_name ." ". $car->carModel->model_name}}</h1>
                            <p class="mt-1 text-sm text-gray-500">
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
                        <p class="text-2xl font-medium">{{number_format($car->minimum_price)}}€</p>
                    </div>
                </div>

                <!-- Informations générales -->
                <div class="w-full mt-4 space-y-4 md:space-y-0 md:flex md:space-x-4">
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
                                <span class="text-xs">{{$car->car_year}}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Kilométrage</span>
                                <span class="text-xs">{{number_format($car->mileage)}} km</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Type de boîte</span>
                                <span class="text-xs">{{$car->boite_vitesse}}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Nombre de portes</span>
                                <span class="text-xs">{{$car->nb_door}}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Provenance</span>
                                <span class="text-xs">{{$car->provenance}}</span>
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
                                <span class="text-xs">{{$car->carburant}}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Puissance fiscale</span>
                                <span class="text-xs">{{number_format($car->puissance_fiscale)}} ch</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Puissance DIN</span>
                                <span class="text-xs">{{number_format($car->puissance_din)}} km</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Impact et Équipement -->
                <div class="w-full mt-4 space-y-4 md:space-y-0 md:flex md:space-x-4">
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
                                <span class="text-xs">{{$car->consommation}}kWh/100km</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Crit'air</span>
                                <span class="text-xs">{{$car->crit_air}}</span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-xs opacity-50">Émission</span>
                                <span class="text-xs">{{$car->co2_emission}}</span>
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
                                <a href="#" class="text-xs text-blue-500 show-equipments-btn hover:underline">Voir plus</a>
                            </div>
                            <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gray-300 opacity-50"></div>
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
                <div id="equipments-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75" style="display: none;">
                    <div class="relative w-3/4 p-4 bg-white rounded-lg">
                        <button id="close-equipments-modal" class="absolute top-0 right-0 px-4 py-2 mt-4 mr-4 text-sm text-white bg-black bg-opacity-50 rounded-lg">Fermer</button>
                        <h2 class="mb-4 text-lg font-medium md:text-xl">Tous les équipements</h2>
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
                <div class="w-full p-4 mt-4 bg-white rounded-lg">
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
                        <p class="text-sm text-gray-700">
                            {{$car->commentaire_vendeur}}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section vendeur pour l'interface PC -->
            <div id="seller-section" class="flex-col hidden p-4 bg-transparent md:flex md:w-1/6 md:fixed md:right-40 md:top-40 md:h-full md:items-center">
                <div class="flex items-center gap-4">
                    <img src="{{ $car->user->profile_picture ? asset('storage/' . $car->user->profile_picture) : asset('assets/default_pfp.png') }}" alt="Photo vendeur" class="w-16 h-16 rounded-full">
                    <div>
                        <h2 class="text-lg font-semibold">{{$car->user->first_name ." ". $car->user->last_name}}</h2>
                        <p class="text-sm text-gray-500">★★★★★</p>
                    </div>
                </div>
                <button class="w-full px-4 py-2 mt-4 text-white !bg-[#3380CC] rounded-lg" @click="if (auctionEnded) { alert('Enchère terminée, il n\'est plus possible d\'enchérir'); } else { alert('Enchère non terminée, il est possible d\'enchérir'); }">Faire une offre</button>
                <p class="mt-2 text-center text-gray-500">Ou</p>
                <div class="flex flex-col mt-2 space-y-2">
                    <button class="px-4 py-2 text-white !bg-[#3380CC] rounded-lg ">Envoyer un message</button>
                    <!-- Bouton "Voir le numéro de téléphone" -->
                    @auth
                    <div x-data="{ showPhone: false }">
                        <button @click="showPhone = !showPhone" class="px-4 py-2 text-[#3380CC] border-2 border-[#3380CC] border-opacity-20 rounded-lg">
                            Voir le numéro de téléphone
                        </button>
                        <div x-show="showPhone" x-transition class="mt-2 text-gray-700">
                            {{ $car->user->telephone }}
                        </div>
                    </div>
                    @endauth
                    @guest
                    <a href="{{ route('auth.login') }}" 
                    class="flex items-center justify-center h-12 px-4 py-2 text-[#3380CC] border-2 border-[#3380CC] border-opacity-20 rounded-lg">
                    Voir le numéro de téléphone
                    </a>
                    @endguest                    
                </div>
                <div class="p-4 mt-4 bg-gray-100 rounded-lg">
                    <livewire:countdown :deadline="$car->deadline" :key="$car->id" />
                </div>
            </div>

            <!-- Section vendeur pour l'interface téléphone -->
            <div id="seller-section-phone" class="fixed left-0 right-0 flex items-center justify-center p-4 bg-white bottom-16 md:hidden">
                <div class="flex w-full space-x-2">
                    <button class="flex-1 px-4 py-2 text-white text-xs !bg-[#3380CC] rounded-lg" @click="if (auctionEnded) { alert('Enchère terminée, il n\'est plus possible d\'enchérir'); } else { /* Logique pour envoyer une offre */ }">Offre</button>
                    <button class="flex-1 px-4 py-2 text-white text-xs !bg-[#3380CC] rounded-lg">Message</button>
                    <!-- Bouton "Voir le numéro de téléphone" -->
                    @auth
                    <div x-data="{ showPhone: false }" class="flex-1">
                        <button @click="copyToClipboard('{{ $car->user->telephone }}')" class="w-full text-xs px-4 py-2 text-[#3380CC] border-2 border-[#3380CC] border-opacity-20 rounded-lg">
                            N° Tél
                        </button>
                    </div>
                    @endauth
                    @guest
                    <a href="{{ route('auth.login') }}" 
                    class="flex items-center justify-center text-xs w-full h-12 px-4 py-2 text-[#3380CC] border-2 border-[#3380CC] border-opacity-20 rounded-lg">
                    N° Tél
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const phoneCarouselImages = document.querySelectorAll('.phone-carousel-image');
        let currentPhoneImage = 0;

        function updatePhoneCarousel() {
            phoneCarouselImages.forEach((img, index) => {
                img.style.display = index === currentPhoneImage ? 'block' : 'none';
            });
        }

        document.getElementById('phone-carousel-prev').addEventListener('click', () => {
            currentPhoneImage = (currentPhoneImage > 0) ? currentPhoneImage - 1 : phoneCarouselImages.length - 1;
            updatePhoneCarousel();
        });

        document.getElementById('phone-carousel-next').addEventListener('click', () => {
            currentPhoneImage = (currentPhoneImage < phoneCarouselImages.length - 1) ? currentPhoneImage + 1 : 0;
            updatePhoneCarousel();
        });

        updatePhoneCarousel();

        // Existing carousel and modal logic
        const photos = [
            @foreach($car->documents as $document)
                @if($document->document_type == 'image')
                    { src: '{{ asset('storage/' . $document->document_content) }}', alt: 'Car Image' },
                @endif
            @endforeach
        ];

        let currentPhoto = 0;
        let showCarousel = false;

        function updateCarousel() {
            const carousel = document.querySelector('.carousel');
            if (carousel) {
                const images = carousel.querySelectorAll('img');
                images.forEach((img, index) => {
                    img.style.display = index === currentPhoto ? 'block' : 'none';
                });

                const previews = carousel.querySelectorAll('.preview-image');
                previews.forEach((preview, index) => {
                    const previewIndex = (currentPhoto + index) % photos.length;
                    preview.src = photos[previewIndex].src;
                    preview.dataset.index = previewIndex;
                });
            }
        }

        document.querySelectorAll('.carousel-button').forEach(button => {
            button.addEventListener('click', () => {
                if (button.dataset.direction === 'prev') {
                    currentPhoto = (currentPhoto > 0) ? currentPhoto - 1 : photos.length - 1;
                } else {
                    currentPhoto = (currentPhoto < photos.length - 1) ? currentPhoto + 1 : 0;
                }
                updateCarousel();
            });
        });

        const carouselCloseButton = document.querySelector('.carousel-close');
        if (carouselCloseButton) {
            carouselCloseButton.addEventListener('click', () => {
                showCarousel = false;
                const carousel = document.querySelector('.carousel');
                if (carousel) {
                    carousel.style.display = 'none';
                }
            });
        }

        const carouselOpenButton = document.querySelector('.carousel-open');
        if (carouselOpenButton) {
            carouselOpenButton.addEventListener('click', () => {
                showCarousel = true;
                const carousel = document.querySelector('.carousel');
                if (carousel) {
                    carousel.style.display = 'flex';
                    updateCarousel();
                }
            });
        }

        document.querySelectorAll('.preview-image').forEach(preview => {
            preview.addEventListener('click', () => {
                currentPhoto = parseInt(preview.dataset.index);
                updateCarousel();
            });
        });

        updateCarousel();

        // Écouteur pour l'événement auction-ended
        window.addEventListener('auction-ended', () => {
            document.querySelectorAll('#seller-section button, #seller-section-phone button').forEach(button => {
                button.disabled = true;
                button.classList.add('disabled');
            });
        });

        // Logique pour afficher le numéro de téléphone
        const showPhoneBtn = document.getElementById('show-phone-btn');
        const phoneNumber = document.getElementById('phone-number');
        if (showPhoneBtn && phoneNumber) {
            showPhoneBtn.addEventListener('click', () => {
                phoneNumber.style.display = phoneNumber.style.display === 'none' ? 'block' : 'none';
            });
        }

        // Logique pour copier le numéro de téléphone
        const copyPhoneBtn = document.getElementById('copy-phone-btn');
        if (copyPhoneBtn) {
            copyPhoneBtn.addEventListener('click', () => {
                navigator.clipboard.writeText('{{ $car->user->telephone }}').then(() => {
                    alert('Numéro de téléphone copié dans le presse-papier');
                });
            });
        }

        // Logique pour afficher le modal des équipements
        const showEquipmentsBtn = document.querySelector('.show-equipments-btn');
        const equipmentsModal = document.getElementById('equipments-modal');
        const closeEquipmentsModalBtn = document.getElementById('close-equipments-modal');

        if (showEquipmentsBtn && equipmentsModal && closeEquipmentsModalBtn) {
            showEquipmentsBtn.addEventListener('click', (event) => {
                event.preventDefault();
                equipmentsModal.style.display = 'flex';
            });

            closeEquipmentsModalBtn.addEventListener('click', () => {
                equipmentsModal.style.display = 'none';
            });

            equipmentsModal.addEventListener('click', (event) => {
                if (event.target === equipmentsModal) {
                    equipmentsModal.style.display = 'none';
                }
            });
        }
    });
</script>

@endsection