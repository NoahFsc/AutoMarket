<div class="flex">
    <div class="hidden md:block">
        @include('catalog.desktop-filters')
    </div>

    <div class="flex flex-col w-full max-w-5xl mx-8 md:mx-auto">

        {{-- Entête --}}
        <div class="flex flex-col items-center justify-between gap-4 mb-4 md:flex-row">
            <p class="text-2xl font-bold md:w-1/2">Catalogue - <span class="text-primary">{{ $cars->total() > 1 ? $cars->total() . ' ' . "annonces" : $cars->total() . ' ' . "annonce" }}</span></p>
            <div class="flex flex-col justify-end flex-grow w-full md:gap-4 md:flex-row">
                @if ($type == 1)
                <button wire:click="toggleTime" class="items-center hidden w-auto gap-2 text-default/50 md:flex focus:outline-none">
                    @if ($sortTime === 'asc')
                        <i class="fa fa-caret-up"></i> Temps restant
                    @elseif ($sortTime === 'desc')
                        <i class="fa fa-caret-down"></i> Temps restant
                    @else
                        <i class="fa fa-minus"></i> Temps restant
                    @endif
                </button>
                @endif
                <button wire:click="togglePrice" class="items-center hidden gap-2 text-default/50 focus:outline-none md:flex">
                    @if ($sortPrice === 'asc')
                        <i class="fa fa-caret-up"></i> Prix
                    @elseif ($sortPrice === 'desc')
                        <i class="fa fa-caret-down"></i> Prix
                    @else
                        <i class="fa fa-minus"></i> Prix
                    @endif
                </button>
                <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full mt-1 border-input-border bg-input rounded-t-md md:rounded-md md:w-96 h-9 focus:border-primary focus:ring-primary">
                <div class="md:hidden">
                    @include('catalog.mobile-filters')
                </div>
            </div>
        </div>

        {{-- Catalogue --}}
        @if(count($cars) > 0)
            <div class="grid gap-4 grid-cols-auto-fit-card">
                @if ($type == 0)
                    @foreach ($cars as $car)
                        <livewire:selling-card :car="$car" :key="$type . $car->id" />
                    @endforeach
                @else
                    @foreach ($cars as $car)
                        <livewire:auction-card :car="$car" :key="$type . $car->id" />
                    @endforeach
                @endif
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
