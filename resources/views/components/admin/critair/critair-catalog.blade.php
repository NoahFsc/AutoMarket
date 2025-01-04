<div class="relative flex flex-col flex-grow gap-4 mt-16 mr-16">

    {{-- Entête --}}
    <div class="flex flex-col">
        <p class="text-2xl font-medium">Gestion des Crit'air</p>
        <p class="text-lg font-medium opacity-50">Gérez les Crit'air disponibles sur AutoMarket</p>
    </div>

    {{-- Barre d'outils --}}
    <div class="flex items-end justify-between">
        <p class="font-medium">Tous les Crit'air <span class="font-medium opacity-50">({{ $critairs->total() }})</span></p>
        <div class="flex items-center gap-2">
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full h-10 mt-1 border-gray-300 rounded-t-md md:rounded-md md:w-96 focus:border-primary-500 focus:ring-primary-500">
            <livewire:critair.manage-critair />
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-300 rounded-lg">
            <thead>
                <tr>
                    <th class="px-6 py-3 font-medium text-left">Image</th>
                    <th class="px-6 py-3 font-medium text-left">Nom</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($critairs as $critair)
                <tr class="border-b border-gray-300">
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $critair->image) }}" alt="{{ $critair->nom }}" class="w-16 h-16">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $critair->nom }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50" id="options-menu">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                <div class="py-1" role="menu">
                                    <button @click="$dispatch('open-manage-critair-modal', { critair_id: {{ $critair->id }} })" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100" role="menuitem">Modifier le Crit'air</button>
                                    <button wire:click="deleteCritair({{ $critair->id }})" class="block w-full px-4 py-2 text-sm text-left text-red-500 hover:bg-gray-100" role="menuitem">Supprimer le Crit'air</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $critairs->links('components.pagination') }}
        </div>
    </div>
</div>