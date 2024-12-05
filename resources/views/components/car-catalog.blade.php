<div class="flex">
    <div class="hidden md:block">
        @include('acheter.desktop-filters')
    </div>

    <div class="flex flex-col w-full max-w-5xl mx-8 md:mx-auto">

        {{-- Entête --}}
        <div class="flex flex-col items-center justify-between gap-4 mb-4 md:flex-row">
            <p class="w-full text-2xl font-bold">Catalogue - <span class="text-primary-500">{{ $cars->total() }} annonces</span></p>
            <div class="flex flex-col justify-end w-full md:gap-4 md:flex-row">
                <button wire:click="toggleSort" class="hidden text-gray-700 md:mr-2 focus:outline-none md:block">
                    @if ($sortDirection === 'asc')
                        <i class="fa fa-caret-up"></i> Prix
                    @elseif ($sortDirection === 'desc')
                        <i class="fa fa-caret-down"></i> Prix
                    @else
                        <i class="fa fa-minus"></i> Prix
                    @endif
                </button>
                <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full mt-1 border-gray-300 rounded-t-md md:rounded-md md:w-96 h-9 focus:border-primary-500 focus:ring-primary-500">
                <div class="md:hidden">
                    @include('acheter.mobile-filters')
                </div>
            </div>
        </div>

        {{-- Catalogue --}}
        @if(count($cars) > 0)
            <div class="grid gap-4 grid-cols-auto-fit-card">
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
