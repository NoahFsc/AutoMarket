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
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='diesel' class="mr-2 bg-transparent rounded-sm">
            <label for="diesel" class="ml-2">Diesel</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='essence' class="mr-2 bg-transparent rounded-sm">
            <label for="essence" class="ml-2">Essence</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='electrique' class="mr-2 bg-transparent rounded-sm">
            <label for="electrique" class="ml-2">Électrique</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='hybride' class="mr-2 bg-transparent rounded-sm">
            <label for="hybride" class="ml-2">Hybride</label>
        </div>
    </div>
    <div>
        <label for="boite" class="block text-base opacity-50">Boîte</label>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='manuelle' class="mr-2 bg-transparent rounded-sm">
            <label for="manuelle" class="ml-2">Manuelle</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='automatique' class="mr-2 bg-transparent rounded-sm">
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
    <div class="mb-4">
        <label for="portes" class="block text-base opacity-50">Portes</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='portes' placeholder="Entrez un nombre" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        </div>
    </div>
    <div class="mb-4">
        <label for="sieges" class="block text-base opacity-50">Sièges</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='sieges' placeholder="Entrez un nombre" class="block w-full mt-1 border-gray-300 rounded-md h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
        </div>
    </div>
</div>