@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('vendre.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Retour à la page
            précédente</a>
    </div>
    <div class="flex justify-center text-3xl font-semibold text-gray-800 mb-10">Poster une annonce</div>
    <div class="mb-6 relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full h-1 bg-white mt-8 mr-8 ml-20"></div>
        </div>
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col items-center">
                <div class="text-gray-700 mb-2">Informations Générales</div>
                <div class="w-8 h-8 border-4 bg-white border-info-500 rounded-full"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-gray-500 mb-2">Documents</div>
                <div class="w-8 h-8 bg-white rounded-full"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="text-gray-500 mb-2">Confirmation</div>
                <div class="w-8 h-8 bg-white rounded-full"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step1') }}" method="POST">
        @csrf
        <div class="flex justify-start text-2xl font-semibold text-gray-800 mb-6">Détails du véhicule</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div>
                <livewire:create-search />
                <label class="block text-gray-500 font-medium mt-4 mb-2">Type de Véhicule</label>
                <select class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-300 text-gray-500"
                    name="type_of_car">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($vehiculeTypes as $vehiculeType)
                    <option value="{{ $vehiculeType->id }}">{{$vehiculeType->nom}}</option>
                    @endforeach
                </select>

                <label class="block text-gray-500 font-medium mt-4 mb-2">Contrôle Technique</label>
                <select class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-300 text-gray-500">
                    <option value="" disabled selected>Sélectionner un état</option>
                    <option>À Jour</option>
                    <option>À Faire</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-500 font-medium mb-2">Année</label>
                <input type="number" class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-300"
                    placeholder="Entrez l'année de mise en circulation">
                <label class="block text-gray-500 font-medium mt-4 mb-2">Provenance</label>
                <input type="text" class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-300"
                    placeholder="Entrez la provenance">
                <label class="block text-gray-500 font-medium mt-4 mb-2">Kilométrage</label>
                <input type="number" class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-300"
                    placeholder="Entrez le kilométrage">
                <label class="block text-gray-500 font-medium mt-4 mb-2">Nombres de portes</label>
                <select
                    class="w-full border-gray-300 text-gray-500 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($nbdoors as $nbdoor)
                    <option value="{{ $nbdoor->id }}">{{$nbdoor->nb_doors}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="text-2xl font-semibold text-gray-800 mb-6">Moteur</div>
                <label class="block text-gray-500 font-medium mb-2">Type de carburant</label>
                <select
                    class="w-full border-gray-300 text-gray-500 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                    <option value="" disabled selected>Sélectionner un type de carburant</option>
                    @foreach ($fueltypes as $fueltype)
                    <option value="{{ $fueltype->id }}">{{$fueltype->nom}}</option>
                    @endforeach
                </select>

                <label class="block text-gray-500 font-medium mt-4 mb-2">Puissance Fiscale</label>
                <input type="number" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Entrez la puissance fiscale">

                <label class="block text-gray-500 font-medium mt-4 mb-2">Puissance DIN</label>
                <input type="number" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Entrez la puissance DIN">
            </div>
            <div>
                <div class="text-2xl font-semibold text-gray-800 mb-6">Pollution</div>
                <label class="block text-gray-500 font-medium mb-2">Consommation</label>
                <input type="number" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Entrez la consommation (/100km)">

                <label class="block text-gray-500 font-medium mt-4 mb-2">Crit'Air</label>
                <select
                    class="w-full border-gray-300 text-gray-500 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($critairs as $critair)
                    <option value="{{ $critair->id }}">{{$critair->nom}}</option>
                    @endforeach
                </select>

                <label class="block text-gray-500 font-medium mt-4 mb-2">Émission de CO2</label>
                <input type="number"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-300"
                    placeholder="Entrez l'émission de CO2">
            </div>
        </div>
        <div class="flex justify-start text-2xl font-semibold text-gray-800 mt-6">Équipement</div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-500 font-medium mt-4 mb-2">Sélection</label>
                <select id="equipment-select"
                    class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-500">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($equipments as $equipment)
                    <option value="{{ $equipment->id }}">{{$equipment->equipment_name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-500 font-medium mt-4 mb-2">Boîte de vitesse</label>
                <select class="w-full border-gray-300 rounded-md focus:ring focus:ring-primary-500">
                    <option value="" disabled selected>Sélectionnez un type boîte de vitesse</option>
                    @foreach ($gearboxes as $gearboxe)
                    <option value="{{ $gearboxe->id }}">{{$gearboxe->nom}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div id="selected-equipments" class="flex flex-wrap mt-4">
            <!-- Les badges des équipements sélectionnés seront ajoutés ici -->
        </div>
        <div class="flex justify-center mt-8 gap-4">
            <button type="button" class="px-6 py-2 border border-gray-300 text-gray-500 rounded-md hover:bg-gray-100"
                onclick="window.history.back()">Étape précédente</button>
            <button type="submit" class="px-6 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-400">Étape
                suivante</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const equipmentSelect = document.getElementById('equipment-select');
        const selectedEquipmentsContainer = document.getElementById('selected-equipments');

        equipmentSelect.addEventListener('change', function () {
            const selectedOption = equipmentSelect.options[equipmentSelect.selectedIndex];
            const equipmentId = selectedOption.value;
            const equipmentName = selectedOption.text;

            if (equipmentId) {
                // Créer un badge pour l'équipement sélectionné
                const badge = document.createElement('div');
                badge.classList.add('bg-blue-500', 'text-white', 'rounded-full', 'px-4', 'py-2', 'mr-2', 'mb-2', 'flex', 'items-center');
                badge.setAttribute('data-id', equipmentId);

                const badgeText = document.createElement('span');
                badgeText.textContent = equipmentName;

                const removeButton = document.createElement('button');
                removeButton.classList.add('ml-2', 'text-white', 'hover:text-gray-300');
                removeButton.innerHTML = '&times;';
                removeButton.addEventListener('click', function () {
                    selectedEquipmentsContainer.removeChild(badge);
                });

                badge.appendChild(badgeText);
                badge.appendChild(removeButton);
                selectedEquipmentsContainer.appendChild(badge);

                // Ajouter un champ caché pour soumettre l'équipement sélectionné
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'equipments[]';
                hiddenInput.value = equipmentId;
                badge.appendChild(hiddenInput);

                // Réinitialiser la sélection
                equipmentSelect.selectedIndex = 0;
            }
        });
    });
</script>

@endsection