@extends('layout')

@section('titre', 'Créer une annonce')

@section('contenu')

<div class="mx-8 md:w-2/4 md:mx-auto">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('vendre.index') }}" class="text-default/50 hover:text-default/80">&larr; Retour à la page précédente</a>
    </div>
    <div class="flex justify-center mb-10 text-3xl font-semibold text-default/80">Poster une annonce</div>
    <div class="relative mb-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full h-1 mt-8 ml-20 mr-8 bg-input"></div>
        </div>
        <div class="relative flex items-center justify-between">
            <div class="flex flex-col items-center">
                <div class="mb-2 text-default/80">Informations Générales</div>
                <div class="w-8 h-8 border-4 rounded-full bg-input border-info"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-default/50">Documents</div>
                <div class="w-8 h-8 rounded-full bg-input"></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="mb-2 text-default/50">Confirmation</div>
                <div class="w-8 h-8 rounded-full bg-input"></div>
            </div>
        </div>
    </div>
    <form action="{{ route('vendre.step1') }}" method="POST">
        @csrf
        <div class="flex justify-start mb-6 text-2xl font-semibold text-default/80">Détails du véhicule</div>
        <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-2">
            <div>
                <livewire:create-search />
                <label class="block mt-4 mb-2 font-medium text-default/50">Type de Véhicule</label>
                <select class="w-full rounded-md border-input-border bg-input text-default/50 focus:ring focus:ring-primary"
                    name="type_of_car_id">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($vehiculeTypes as $vehiculeType)
                    <option value="{{ $vehiculeType->id }}">{{$vehiculeType->nom}}</option>
                    @endforeach
                </select>

                <label class="block mt-4 mb-2 font-medium text-default/50">Contrôle Technique</label>
                <select class="w-full rounded-md border-input-border bg-input text-default/50 focus:ring focus:ring-primary"
                    name="status_ct">
                    <option value="" disabled selected>Sélectionner un état</option>
                    <option>À Jour</option>
                    <option>À Faire</option>
                </select>
            </div>
            <div>
                <label class="block mb-2 font-medium text-default/50">Année</label>
                <input type="number" class="w-full rounded-md border-input-border bg-input focus:ring focus:ring-primary"
                    placeholder="Entrez l'année de mise en circulation" name="car_year">
                <label class="block mt-4 mb-2 font-medium text-default/50">Provenance</label>
                <input type="text" class="w-full rounded-md border-input-border bg-input focus:ring focus:ring-primary"
                    placeholder="Entrez la provenance" name="provenance">
                <label class="block mt-4 mb-2 font-medium text-default/50">Kilométrage</label>
                <input type="number" class="w-full rounded-md border-input-border bg-input focus:ring focus:ring-primary"
                    placeholder="Entrez le kilométrage" name="mileage">
                <label class="block mt-4 mb-2 font-medium text-default/50">Nombres de portes</label>
                <select class="w-full rounded-md shadow-sm border-input-border bg-input text-default/50 focus:ring focus:ring-primary"
                    name="nb_door_id">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($nbdoors as $nbdoor)
                    <option value="{{ $nbdoor->id }}">{{$nbdoor->nb_doors}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <div class="mb-6 text-2xl font-semibold text-default/80">Moteur</div>
                <label class="block mb-2 font-medium text-default/50">Type de carburant</label>
                <select class="w-full rounded-md shadow-sm border-input-border bg-input text-default/50 focus:ring focus:ring-primary"
                    name="carburant_id">
                    <option value="" disabled selected>Sélectionner un type de carburant</option>
                    @foreach ($fueltypes as $fueltype)
                    <option value="{{ $fueltype->id }}">{{$fueltype->nom}}</option>
                    @endforeach
                </select>

                <label class="block mt-4 mb-2 font-medium text-default/50">Puissance Fiscale</label>
                <input type="number" class="w-full rounded-md shadow-sm border-input-border bg-input focus:ring focus:ring-primary"
                    placeholder="Entrez la puissance fiscale" name="puissance_fiscale">

                <label class="block mt-4 mb-2 font-medium text-default/50">Puissance DIN</label>
                <input type="number" class="w-full rounded-md shadow-sm border-input-border bg-input focus:ring focus:ring-primary"
                    placeholder="Entrez la puissance DIN" name="puissance_din">
            </div>
            <div>
                <div class="mb-6 text-2xl font-semibold text-default/80">Pollution</div>
                <label class="block mb-2 font-medium text-default/50">Consommation</label>
                <input type="number" class="w-full rounded-md shadow-sm border-input-border bg-input focus:ring focus:ring-primary"
                    placeholder="Entrez la consommation (/100km)" name="consommation">

                <label class="block mt-4 mb-2 font-medium text-default/50">Crit'Air</label>
                <select class="w-full rounded-md shadow-sm border-input-border bg-input text-default/50 focus:ring focus:ring-primary"
                    name="crit_air_id">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($critairs as $critair)
                    <option value="{{ $critair->id }}">{{$critair->nom}}</option>
                    @endforeach
                </select>

                <label class="block mt-4 mb-2 font-medium text-default/50">Émission de CO2</label>
                <input type="number"
                    class="w-full rounded-md shadow-sm border-input-border bg-input focus:border-blue-500 focus:ring focus:ring-primary"
                    placeholder="Entrez l'émission de CO2" name="co2_emission">
            </div>
        </div>
        <div class="flex justify-start mt-6 text-2xl font-semibold text-default/80">Équipement</div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="block mt-4 mb-2 font-medium text-default/50">Sélection</label>
                <select id="equipment-select" class="w-full rounded-md border-input-border bg-input focus:ring focus:ring-primary" name="equipments[]">
                    <option value="" disabled selected>Sélectionnez un niveau</option>
                    @foreach ($equipments as $equipment)
                        <option value="{{ $equipment->id }}">{{$equipment->equipment_name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mt-4 mb-2 font-medium text-default/50">Boîte de vitesse</label>
                <select class="w-full rounded-md border-input-border bg-input focus:ring focus:ring-primary"
                    name="boite_vitesse_id">
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
        <div class="flex justify-center gap-4 mt-8">
            <button type="button" class="px-6 py-2 border rounded-md border-input-border bg-input text-default/50 hover:bg-input/50"
                onclick="window.history.back()">Étape précédente</button>
            <button type="submit" class="px-6 py-2 text-white rounded-md bg-primary hover:bg-opacity-80">Étape
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
