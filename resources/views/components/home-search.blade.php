<div class="mt-8 flex-col flex justify-center items-center md:flex-row">
    <div class="w-full">
        <label for="brand" class="text-gray-500 text-xs md:block">Marque</label>
        <select wire:model.live="marqueSelectionnee"
            class="border px-4 py-2 md:rounded-l-lg rounded-t-lg md:rounded-tr-none w-full">
            <option value="" disabled {{ empty($marqueSelectionnee) ? 'selected' : '' }}>Sélectionnez une marque
            </option>
            @foreach ($brands as $brand)
            <option value="{{ $brand['id'] }}">{{$brand['brand_name']}}
            </option>
            @endforeach
        </select>
    </div>
    <div class="w-full flex flex-col">
        <label for="carModel" class="text-gray-500 text-xs">Modèle</label>
        <select wire:model.live="modeleSelectionne" class="border px-4 py-2">
            <option value="" disabled {{ empty($modeleSelectionne) ? 'selected' : '' }}>Sélectionnez un modèle</option>
            @foreach ($carModels as $carModel)
            <option value="{{ $carModel['id'] }}">{{$carModel['model_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full">
        <p class="text-gray-500 text-xs">Kilométrage max</p>
        <input type="number" placeholder="Kilométrage max" wire:model.live="kmMax"
            class="border-t border-b border-r px-4 py-2 w-full" />
    </div>
    <div class="w-full">
        <p class="text-gray-500 text-xs">Code Postal</p>
        <input type="text" placeholder="Entrez un code postal" wire:model.live="codePostal"
            class="border-t border-b border-r px-4 py-2 w-full" />
    </div>
    <div class="w-full">
        <label for="price" class="text-background text-xs hidden md:block">eqzhgf</label>
        <button wire:click="sendFilters"
            class="bg-blue-500 text-white px-4 py-2 md:rounded-r-lg rounded-b-lg md:rounded-bl-none w-full">Parcourir</button>
    </div>
</div>