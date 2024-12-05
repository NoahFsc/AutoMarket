<div class="px-3 bg-white border border-x-gray-300 border-b-gray-300 rounded-b-md">
    <button onclick="toggleAccordion(1)" class="flex items-center justify-between w-full py-2 outline-none">
        <span><i class="fa-solid fa-filter-list"></i> Filtres</span>
        <span id="icon-1" class="transition-transform duration-300 text-slate-800">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </button>
    <div id="content-1" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
        <div class="pb-5">
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
            <div>
                <label for="carburant" class="text-base opacity-50">Carburant</label>
                <div class="flex justify-between">
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='diesel' class="mr-2 bg-transparent rounded-sm">
                        <label for="diesel" class="ml-2">Diesel</label>
                    </div>
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='essence' class="mr-2 bg-transparent rounded-sm">
                        <label for="essence" class="ml-2">Essence</label>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='electrique' class="mr-2 bg-transparent rounded-sm">
                        <label for="electrique" class="ml-2">Électrique</label>
                    </div>
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='hybride' class="mr-2 bg-transparent rounded-sm">
                        <label for="hybride" class="ml-2">Hybride</label>
                    </div>
                </div>
            </div>
            <div>
                <label for="boite" class="text-base opacity-50">Boîte</label>
                <div class="flex justify-between">
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='manuelle' class="mr-2 bg-transparent rounded-sm">
                        <label for="manuelle" class="ml-2">Manuelle</label>
                    </div>
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='automatique' class="mr-2 bg-transparent rounded-sm">
                        <label for="automatique" class="ml-2">Automatique</label>
                    </div>
                </div>
            </div>
            <div>
                <label for="vendeur" class="text-base opacity-50">Vendeur</label>
                <div class="flex justify-between">
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='non_verifie' class="mr-2 bg-transparent rounded-sm">
                        <label for="non-verifie" class="ml-2">Non vérifié</label>
                    </div>
                    <div class="flex items-center w-full mb-2">
                        <input type="checkbox" wire:model.live='verifie' class="mr-2 bg-transparent rounded-sm">
                        <label for="verifie" class="ml-2">Vérifié</label>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="portes" class="text-base opacity-50">Portes</label>
                <div class="flex gap-2">
                    <input type="text" wire:model.live='portes' placeholder="Entrez un nombre" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>
            <div class="mb-4">
                <label for="sieges" class="text-base opacity-50">Sièges</label>
                <div class="flex gap-2">
                    <input type="text" wire:model.live='sieges' placeholder="Entrez un nombre" class="w-full h-10 mt-1 border-gray-300 rounded-md focus:border-primary-500 focus:ring-primary-500">
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