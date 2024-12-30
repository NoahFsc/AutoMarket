<div class="p-4 border-r w-52 border-opacity-20">
    <h3 class="mb-4 text-2xl font-semibold">Filtres</h3>
    <div class="mb-4">
        <label for="brand" class="block text-base opacity-50">Marque</label>
        <select wire:model.live="selectedBrand" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">Toutes les marques</option>
            @foreach($brands as $brand)
                <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="carModel" class="block text-base opacity-50">Modèle</label>
        <select wire:model.live="selectedCarModel" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <option value="">Tous les modèles</option>
            @foreach($carModels as $carModel)
                <option value="{{ $carModel['id'] }}">{{ $carModel['model_name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="postal_code" class="block text-base opacity-50">Région</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='postal_code' placeholder="Code postal" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        </div>
    </div>
    <div class="mb-4">
        <label for="kilometrage_min" class="block text-base opacity-50">Kilométrage</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='kilometrage_min' placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <input type="text" wire:model.live='kilometrage_max' placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        </div>
    </div>
    <div class="mb-4">
        <label for="price_min" class="block text-base opacity-50">Prix</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='price_min' placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            <input type="text" wire:model.live='price_max' placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        </div>
    </div>
    <div>
        <label for="carburant" class="block text-base opacity-50">Carburant</label>
        @foreach ($carburants as $carburant)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedCarburants' value="{{ $carburant['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="carburant_{{ $carburant['id'] }}" class="ml-2">{{ $carburant['nom'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="nb_door" class="block text-base opacity-50">Nombre de portes</label>
        @foreach ($nbDoors as $nbDoor)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedNbDoors' value="{{ $nbDoor['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="nb_door_{{ $nbDoor['id'] }}" class="ml-2">{{ $nbDoor['nb_doors'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="critair" class="block text-base opacity-50">Crit'Air</label>
        @foreach ($critairs as $critair)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedCritairs' value="{{ $critair['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="crit_air_{{ $critair['id'] }}" class="ml-2">{{ $critair['nom'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="boite" class="block text-base opacity-50">Boîte</label>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='selectedBoites' value="0" class="mr-2 bg-transparent rounded-sm">
            <label for="manuelle" class="ml-2">Manuelle</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='selectedBoites' value="1" class="mr-2 bg-transparent rounded-sm">
            <label for="automatique" class="ml-2">Automatique</label>
        </div>
    </div>
    <div>
        <label for="vendeur" class="block text-base opacity-50">Vendeur</label>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='non_verifie' class="mr-2 bg-transparent rounded-sm">
            <label for="non-verifie" class="ml-2">Non vérifié</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='verifie' class="mr-2 bg-transparent rounded-sm">
            <label for="verifie" class="ml-2">Vérifié</label>
        </div>
    </div>
</div>