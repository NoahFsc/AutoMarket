<div>
    <div class="mb-2">
        <label class="block mb-2 font-medium text-default/50">{{ __('Brand') }}</label>
        <select wire:model.live="marqueSelectionnee"
            class="w-full rounded-md text-default/50 border-input-border bg-input focus:ring focus:ring-primary">
            <option value="" disabled>{{ __('SelectBrand') }}</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4 mb-2">
        <label class="block mb-2 font-medium text-default/50">{{ __('Model') }}</label>
        <select wire:model.live="modeleSelectionne" name="model_id"
            class="w-full rounded-md text-default/50 border-input-border bg-input focus:ring focus:ring-primary">
            <option value="" disabled>{{ __('SelectModel') }}</option>
            @foreach ($carModels as $carModel)
            <option value="{{ $carModel['id'] }}">{{ $carModel['model_name'] }}</option>
            @endforeach
        </select>
    </div>
</div>