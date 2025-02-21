<div class="relative flex flex-col flex-grow gap-4 mt-16 mr-16">

    {{-- Entête --}}
    <div class="flex flex-col">
        <p class="text-2xl font-medium">Gestion des nombres de portières</p>
        <p class="text-lg font-medium opacity-50">Gérez les nombres de portières disponibles sur AutoMarket</p>
    </div>

    {{-- Barre d'outils --}}
    <div class="flex items-end justify-between">
        <p class="font-medium">Tous les nombres de portières <span class="font-medium opacity-50">({{ $nbDoors->total() }})</span></p>
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full h-10 mt-1 border-input-border bg-input rounded-t-md md:rounded-md md:w-96 focus:border-primary">
            <livewire:nb-door.manage-nb-door />
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full rounded-lg bg-input-border">
        <caption id="nbDoorsTableDescription" class="sr-only">Tableau listant tous les nombres de portières disponibles sur AutoMarket avec des options pour modifier ou supprimer chaque nombre de portières.</caption>
            <thead>
                <tr>
                    <th class="px-6 py-3 font-medium text-left">Nombre de portières</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-reverse">
                @foreach($nbDoors as $nbDoor)
                <tr class="border-b border-input-border bg-input/80">
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-default/80">{{ $nbDoor->nb_doors }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium border rounded-md text-default/80 border-input-border hover:bg-default/5" id="options-menu">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 rounded-md shadow-lg bg-input ring-1 ring-black ring-opacity-5">
                                <div class="py-1" role="menu">
                                    <button @click="$dispatch('open-manage-nb-door-modal', { nb_door_id: {{ $nbDoor->id }} })" class="block w-full px-4 py-2 text-sm text-left text-default/80 hover:bg-default/5" role="menuitem">Modifier le nombre de portières</button>
                                    <button wire:click="deleteNbDoor({{ $nbDoor->id }})" class="block w-full px-4 py-2 text-sm text-left text-red-500 hover:bg-default/5" role="menuitem">Supprimer le nombre de portières</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $nbDoors->links('components.pagination') }}
        </div>
    </div>
</div>
