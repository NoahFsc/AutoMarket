<div class="flex flex-col items-center justify-center mt-8 md:flex-row">
    <div class="flex flex-col w-full bg-white border border-gray-300 rounded-t-md md:rounded-l-md md:rounded-tr-none">
        <p class="mt-1 ml-4 text-sm opacity-50">Marque</p>
        <select wire:model.live="marqueSelectionnee" class="px-4 py-1 border-none md:rounded-l-md no-outline">
            <option value="" disabled>Sélectionnez une marque</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand['id'] }}">{{$brand['brand_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col w-full bg-white border border-gray-300">
        <p class="mt-1 ml-4 text-sm opacity-50">Modèle</p>
        <select wire:model.live="modeleSelectionne" class="px-4 py-1 border-none no-outline">
            <option value="" disabled>Sélectionnez un modèle</option>
            @foreach ($carModels as $carModel)
            <option value="{{ $carModel['id'] }}">{{$carModel['model_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col w-full bg-white border border-gray-300">
        <p class="mt-1 ml-4 text-sm opacity-50">Kilométrage</p>
        <input type="number" placeholder="Kilométrage max" wire:model.live="kmMax" class="w-full px-4 py-1 border-none no-outline" />
    </div>
    <div class="flex flex-col w-full bg-white border border-gray-300">
        <p class="mt-1 ml-4 text-sm opacity-50">Code Postal</p>
        <input type="text" placeholder="Entrez un code postal" wire:model.live="codePostal" class="w-full px-4 py-1 border-none no-outline" />
    </div>
    <button wire:click="sendFilters" class="w-full px-8 py-3 text-white border-4 rounded-b-md md:w-auto border-primary-500 bg-primary-500 md:rounded-r-lg md:rounded-bl-none">Parcourir</button>
</div>