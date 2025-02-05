<div>
    <div class="mb-2">
        <label class="block mb-2 font-medium text-gray-500">Marque</label>
        <select wire:model.live="marqueSelectionnee"
            class="w-full text-gray-500 border-gray-300 rounded-md focus:ring focus:ring-primary">
            <option value="" disabled>Sélectionnez une marque</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4 mb-2">
        <label class="block mb-2 font-medium text-gray-500">Modèle</label>
        <select wire:model.live="modeleSelectionne" name="model_id"
            class="w-full text-gray-500 border-gray-300 rounded-md focus:ring focus:ring-primary">
            <option value="" disabled>Sélectionnez un modèle</option>
            @foreach ($carModels as $carModel)
            <option value="{{ $carModel['id'] }}">{{ $carModel['model_name'] }}</option>
            @endforeach
        </select>
    </div>
</div>