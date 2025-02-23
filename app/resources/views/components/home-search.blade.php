<div class="flex flex-col items-center justify-center mt-8 md:flex-row">
    <div class="flex flex-col w-full border border-input-border bg-input rounded-t-md md:rounded-l-md md:rounded-tr-none">
        <p class="mt-1 ml-4 text-sm opacity-50">{{ __('SearchBrand') }}</p>
        <select wire:model.live="marqueSelectionnee" class="px-4 py-1 border-none md:rounded-l-md no-outline bg-input">
            <option value="" disabled>{{ __('SearchSelectBrand') }}</option>
            @foreach ($brands as $brand)
            <option value="{{ $brand['id'] }}">{{$brand['brand_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col w-full border border-input-border bg-input">
        <p class="mt-1 ml-4 text-sm opacity-50">{{ __('SearchModel') }}</p>
        <select wire:model.live="modeleSelectionne" class="px-4 py-1 border-none no-outline bg-input">
            <option value="" disabled>{{ __('SearchSelectModel') }}</option>
            @foreach ($carModels as $carModel)
            <option value="{{ $carModel['id'] }}">{{$carModel['model_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="flex flex-col w-full border border-input-border bg-input">
        <p class="mt-1 ml-4 text-sm opacity-50">{{ __('SearchMileage') }}</p>
        <input type="number" placeholder="{{ __('SearchMaxMileage') }}" wire:model.live="kmMax" class="w-full px-4 py-1 border-none no-outline bg-input" />
    </div>
    <div class="flex flex-col w-full border border-input-border bg-input">
        <p class="mt-1 ml-4 text-sm opacity-50">{{ __('SearchPostalCode') }}</p>
        <input type="text" placeholder="{{ __('SearchEnterPostalCode') }}" wire:model.live="codePostal" class="w-full px-4 py-1 border-none no-outline bg-input" />
    </div>
    <button wire:click="sendFilters" class="w-full px-8 py-3 text-white border-4 rounded-b-md md:w-auto border-primary bg-primary md:rounded-r-lg md:rounded-bl-none hover:bg-primary/80 hover:border-opacity-80">{{ __('SearchButton') }}</button>
</div>