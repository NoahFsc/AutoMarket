<div class="relative flex flex-col flex-grow gap-4 mt-16 mr-16">

    {{-- Entête --}}
    <div class="flex flex-col">
        <p class="text-2xl font-medium">Gestion des annonces</p>
        <p class="text-lg font-medium opacity-50">Gérez les annonces postées sur AutoMarket</p>
    </div>

    {{-- Barre d'outils --}}
    <div class="flex items-end justify-between">
        <p class="font-medium">Toutes les annonces <span class="font-medium opacity-50">({{ $cars->total() }})</span></p>
        <div>
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full h-10 mt-1 border-gray-300 rounded-t-md md:rounded-md md:w-96 focus:border-primary focus:ring-primary">
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-300 rounded-lg">
            <thead>
                <tr>
                    <th class="px-6 py-3 font-medium text-left">Intitulé d'annonce</th>
                    <th class="px-6 py-3 font-medium text-left">Type</th>
                    <th class="px-6 py-3 font-medium text-left">Vendeur</th>
                    <th class="px-6 py-3 font-medium text-left">Date de dépôt</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($cars as $car)
                <tr class="border-b border-gray-300">
                    <td class="flex items-center gap-4 px-6 py-4">
                        <img class="h-10" src="{{ asset('storage/' . $car->imageDocument->document_content) }}" alt="Photo de profil">
                        <div class="text-sm font-medium text-gray-900">{{ $car->carModel->brand->brand_name }} {{ $car->carModel->model_name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-2 text-xs font-semibold {{ $car->vente_enchere ? 'text-blue-800 bg-blue-100' : 'text-green-800 bg-green-100' }} rounded-full">
                            {{ $car->vente_enchere ? 'Enchère' : 'Vente' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $car->user->first_name }} {{ $car->user->last_name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($car->created_at)->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50" id="options-menu">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                <div class="py-1" role="menu">
                                    <a href="{{ $car->vente_enchere ? route('produit.enchere', $car->id) : route('produit.vente', $car->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Voir l'annonce</a>
                                    <a href="{{ $car->vente_enchere ? route('produit.enchere', ['id' => $car->id, 'from' => 'admin']) : route('produit.vente', ['id' => $car->id, 'from' => 'admin']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Modifier l'annonce</a>
                                    <button wire:click="deleteOffer({{ $car->id }})" class="block w-full px-4 py-2 text-sm text-left text-red-500 hover:bg-gray-100" role="menuitem">Supprimer l'annonce</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $cars->links('components.pagination') }}
        </div>
    </div>
</div>