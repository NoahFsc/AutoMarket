<div class="flex">
    @include('acheter.desktop-filters')

    <div class="flex flex-col w-full max-w-5xl mx-auto">
        <div class="flex flex-col items-center justify-between mb-4 md:flex-row">
            <p class="text-2xl font-bold">Catalogue - <span class="text-primary-500">{{ $cars->total() }} annonces</span></p>
            <div class="flex gap-4 md:block">
                <button wire:click="toggleSort" class="text-gray-700 md:mr-2 focus:outline-none">
                    @if ($sortDirection === 'asc')
                        <i class="fa fa-caret-up"></i> Prix
                    @elseif ($sortDirection === 'desc')
                        <i class="fa fa-caret-down"></i> Prix
                    @else
                        <i class="fa fa-minus"></i> Prix
                    @endif
                </button>
                <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full mt-1 border-gray-300 rounded-md shadow-sm md:w-96 h-9 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div class="block md:hidden">
                @include('acheter.mobile-filters')
            </div>
        </div>

        @if(count($cars) > 0)
            <div class="grid grid-cols-3 gap-4">
                @foreach ($cars as $car)
                    @livewire('selling-card', ['car' => $car], key($car->id))
                @endforeach
            </div>
            <div class="mt-4">
                {{ $cars->links('components.pagination') }}
            </div>
        @else
            <div class="flex items-center justify-center h-64">
                <p class="text-lg text-gray-500">Aucun résultat trouvé</p>
            </div>
        @endif
    </div>
</div>
