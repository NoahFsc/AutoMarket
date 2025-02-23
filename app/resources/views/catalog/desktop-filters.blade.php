<div class="p-4 border-r w-52 border-opacity-20">
    <h3 class="mb-4 text-2xl font-semibold">{{ __('Filters') }}</h3>
    <div class="mb-4">
        <label for="brand" class="block text-base opacity-50">{{ __('Brand') }}</label>
        <select wire:model.live="selectedBrand" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
            <option value="">{{ __('AllBrands') }}</option>
            @foreach($brands as $brand)
                <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="carModel" class="block text-base opacity-50">{{ __('Model') }}</label>
        <select wire:model.live="selectedCarModel" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
            <option value="">{{ __('AllModels') }}</option>
            @foreach($carModels as $carModel)
                <option value="{{ $carModel['id'] }}">{{ $carModel['model_name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="postal_code" class="block text-base opacity-50">{{ __('Region') }}</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='postal_code' placeholder="{{ __('PostalCode') }}" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
        </div>
    </div>
    <div class="mb-4">
        <label for="kilometrage_min" class="block text-base opacity-50">{{ __('Mileage') }}</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='kilometrage_min' placeholder="{{ __('Min') }}" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
            <input type="text" wire:model.live='kilometrage_max' placeholder="{{ __('Max') }}" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
        </div>
    </div>
    <div class="mb-4">
        <label for="price_min" class="block text-base opacity-50">{{ __('Price') }}</label>
        <div class="flex gap-2">
            <input type="text" wire:model.live='price_min' placeholder="{{ __('Min') }}" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
            <input type="text" wire:model.live='price_max' placeholder="{{ __('Max') }}" class="block w-full mt-1 rounded-md border-input-border bg-input h-9 focus:border-primary sm:text-sm">
        </div>
    </div>
    <div>
        <label for="carburant" class="block text-base opacity-50">{{ __('Fuel') }}</label>
        @foreach ($carburants as $carburant)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedCarburants' value="{{ $carburant['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="carburant_{{ $carburant['id'] }}" class="ml-2">{{ $carburant['nom'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="nb_door" class="block text-base opacity-50">{{ __('Doors') }}</label>
        @foreach ($nbDoors as $nbDoor)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedNbDoors' value="{{ $nbDoor['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="nb_door_{{ $nbDoor['id'] }}" class="ml-2">{{ $nbDoor['nb_doors'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="critair" class="block text-base opacity-50">{{ __('CritAir') }}</label>
        @foreach ($critairs as $critair)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedCritairs' value="{{ $critair['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="crit_air_{{ $critair['id'] }}" class="ml-2">{{ $critair['nom'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="boite" class="block text-base opacity-50">{{ __('GearBox') }}</label>
        @foreach ($boites as $boite)
            <div class="flex items-center mb-2">
                <input type="checkbox" wire:model.live='selectedGearBoxes' value="{{ $boite['id'] }}" class="mr-2 bg-transparent rounded-sm">
                <label for="boite_{{ $boite['id'] }}" class="ml-2">{{ $boite['nom'] }}</label>
            </div>
        @endforeach
    </div>
    <div>
        <label for="vendeur" class="block text-base opacity-50">{{ __('Seller') }}</label>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='non_verifie' class="mr-2 bg-transparent rounded-sm">
            <label for="non-verifie" class="ml-2">{{ __('Unverified') }}</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="checkbox" wire:model.live='verifie' class="mr-2 bg-transparent rounded-sm">
            <label for="verifie" class="ml-2">{{ __('Verified') }}</label>
        </div>
    </div>
</div>