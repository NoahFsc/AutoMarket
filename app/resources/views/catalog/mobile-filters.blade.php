<div class="px-3 border bg-input border-input-border border-b-input-border rounded-b-md">
    <button onclick="toggleAccordion(1)" class="flex items-center justify-between w-full py-2 outline-none">
        <span><i class="fa-solid fa-filter-list"></i> {{ __('Filters') }}</span>
        <span id="icon-1" class="transition-transform duration-300 text-slate-800">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </button>
    <div id="content-1" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
        <div class="mb-4">
            <label for="brand" class="opacity-50">{{ __('Brand') }}</label>
            <select wire:model.live="selectedBrand" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
                <option value="">{{ __('AllBrands') }}</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="carModel" class="text-base opacity-50">{{ __('Model') }}</label>
            <select wire:model.live="selectedCarModel" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
                <option value="">{{ __('AllModels') }}</option>
                @foreach($carModels as $carModel)
                    <option value="{{ $carModel['id'] }}">{{ $carModel['model_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="postal_code" class="text-base opacity-50">{{ __('Region') }}</label>
            <div class="flex gap-2">
                <input type="text" wire:model.live='postal_code' placeholder="{{ __('PostalCode') }}" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
            </div>
        </div>
        <div class="mb-4">
            <label for="kilometrage_min" class="text-base opacity-50">{{ __('Mileage') }}</label>
            <div class="flex gap-2">
                <input type="text" wire:model.live='kilometrage_min' placeholder="{{ __('Min') }}" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
                <input type="text" wire:model.live='kilometrage_max' placeholder="{{ __('Max') }}" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
            </div>
        </div>
        <div class="mb-4">
            <label for="price_min" class="text-base opacity-50">{{ __('Price') }}</label>
            <div class="flex gap-2">
                <input type="text" wire:model.live='price_min' placeholder="{{ __('Min') }}" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
                <input type="text" wire:model.live='price_max' placeholder="{{ __('Max') }}" class="w-full h-10 mt-1 rounded-md border-input-border bg-background focus:border-primary focus:ring-primary">
            </div>
        </div>
        <div class="mb-4">
            <label for="carburant" class="text-base opacity-50">{{ __('Fuel') }}</label>
            <div class="flex flex-wrap">
                @foreach ($carburants as $carburant)
                    <div class="flex items-center w-1/2 mb-2">
                        <input type="checkbox" wire:model.live='selectedCarburants' value="{{ $carburant['id'] }}" class="mr-2 bg-transparent rounded-sm">
                        <label for="carburant_{{ $carburant['id'] }}" class="ml-2">{{ $carburant['nom'] }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <label for="nb_door" class="text-base opacity-50">{{ __('Doors') }}</label>
            <div class="flex flex-wrap">
                @foreach ($nbDoors as $nbDoor)
                    <div class="flex items-center w-1/2 mb-2">
                        <input type="checkbox" wire:model.live='selectedNbDoors' value="{{ $nbDoor['id'] }}" class="mr-2 bg-transparent rounded-sm">
                        <label for="nb_door_{{ $nbDoor['id'] }}" class="ml-2">{{ $nbDoor['nb_doors'] }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <label for="critair" class="text-base opacity-50">{{ __('CritAir') }}</label>
            <div class="flex flex-wrap">
                @foreach ($critairs as $critair)
                    <div class="flex items-center w-1/2 mb-2">
                        <input type="checkbox" wire:model.live='selectedCritairs' value="{{ $critair['id'] }}" class="mr-2 bg-transparent rounded-sm">
                        <label for="crit_air_{{ $critair['id'] }}" class="ml-2">{{ $critair['nom'] }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <label for="boite" class="text-base opacity-50">{{ __('GearBox') }}</label>
            <div class="flex flex-wrap">
                @foreach ($boites as $boite)
                    <div class="flex items-center w-1/2 mb-2">
                        <input type="checkbox" wire:model.live='selectedGearBoxes' value="{{ $boite['id'] }}" class="mr-2 bg-transparent rounded-sm">
                        <label for="boite_{{ $boite['id'] }}" class="ml-2">{{ $boite['nom'] }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <label for="vendeur" class="text-base opacity-50">{{ __('Seller') }}</label>
            <div class="flex items-center">
                <div class="w-1/2">
                    <input type="checkbox" wire:model.live='non_verifie' class="mr-2 bg-transparent rounded-sm">
                    <label for="non-verifie" class="ml-2">{{ __('Unverified') }}</label>
                </div>
                <div class="w-1/2">
                    <input type="checkbox" wire:model.live='verifie' class="mr-2 bg-transparent rounded-sm">
                    <label for="verifie" class="ml-2">{{ __('Verified') }}</label>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAccordion(index) {
        const content = document.getElementById(`content-${index}`);
        const icon = document.getElementById(`icon-${index}`);

        const downChevron = `<i class="fa-solid fa-chevron-up"></i>`;
        const upChevron = `<i class="fa-solid fa-chevron-down"></i>`;

        // Toggle the content's max-height for smooth opening and closing
        if (content.style.maxHeight && content.style.maxHeight !== '0px') {
            content.style.maxHeight = '0';
            icon.innerHTML = upChevron;
        } else {
            content.style.maxHeight = content.scrollHeight + 'px';
            icon.innerHTML = downChevron;
        }
    }
</script>