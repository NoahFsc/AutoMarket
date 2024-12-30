<div class="px-3 bg-white border border-x-gray-300 border-b-gray-300 rounded-b-md">
    <button onclick="toggleAccordion(1)" class="flex items-center justify-between w-full py-2 outline-none">
        <span><i class="fa-solid fa-filter-list"></i> Filtres</span>
        <span id="icon-1" class="transition-transform duration-300 text-slate-800">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </button>
    <div id="content-1" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
        <div class="mb-4">
            <label for="brand" class="opacity-50">Marque</label>
            <select wire:model.live="selectedBrand" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
                <option value="">Toutes les marques</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="carModel" class="text-base opacity-50">Modèle</label>
            <select wire:model.live="selectedCarModel" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
                <option value="">Tous les modèles</option>
                @foreach($carModels as $carModel)
                    <option value="{{ $carModel['id'] }}">{{ $carModel['model_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="postal_code" class="text-base opacity-50">Région</label>
            <div class="flex gap-2">
                <input type="text" wire:model.live='postal_code' placeholder="Code postal" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
            </div>
        </div>
        <div class="mb-4">
            <label for="kilometrage_min" class="text-base opacity-50">Kilométrage</label>
            <div class="flex gap-2">
                <input type="text" wire:model.live='kilometrage_min' placeholder="Min" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
                <input type="text" wire:model.live='kilometrage_max' placeholder="Max" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
            </div>
        </div>
        <div class="mb-4">
            <label for="price_min" class="text-base opacity-50">Prix</label>
            <div class="flex gap-2">
                <input type="text" wire:model.live='price_min' placeholder="Min" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
                <input type="text" wire:model.live='price_max' placeholder="Max" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
            </div>
        </div>
        <div class="mb-4">
            <label for="carburant" class="text-base opacity-50">Carburant</label>
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
            <label for="nb_door" class="text-base opacity-50">Nombre de portes</label>
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
            <label for="critair" class="text-base opacity-50">Crit'Air</label>
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
            <label for="boite" class="text-base opacity-50">Boîte</label>
            <div class="flex flex-wrap">
                <div class="flex items-center w-1/2 mb-2">
                    <input type="checkbox" wire:model.live='selectedBoites' value="0" class="mr-2 bg-transparent rounded-sm">
                    <label for="manuelle" class="ml-2">Manuelle</label>
                </div>
                <div class="flex items-center w-1/2 mb-2">
                    <input type="checkbox" wire:model.live='selectedBoites' value="1" class="mr-2 bg-transparent rounded-sm">
                    <label for="automatique" class="ml-2">Automatique</label>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label for="vendeur" class="text-base opacity-50">Vendeur</label>
            <div class="flex items-center">
                <div class="w-1/2">
                    <input type="checkbox" wire:model.live='non_verifie' class="mr-2 bg-transparent rounded-sm">
                    <label for="non-verifie" class="ml-2">Non vérifié</label>
                </div>
                <div class="w-1/2">
                    <input type="checkbox" wire:model.live='verifie' class="mr-2 bg-transparent rounded-sm">
                    <label for="verifie" class="ml-2">Vérifié</label>
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