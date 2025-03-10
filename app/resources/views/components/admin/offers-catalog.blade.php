<div class="relative flex flex-col flex-grow gap-4 mt-16 mr-16">

    {{-- Entête --}}
    <div class="flex flex-col">
        <p class="text-2xl font-medium">{{ __('OfferManagement') }}</p>
        <p class="text-lg font-medium opacity-50">{{ __('ManageOffers') }}</p>
    </div>

    {{-- Barre d'outils --}}
    <div class="flex items-end justify-between">
        <p class="font-medium">{{ __('AllOffers') }} <span class="font-medium opacity-50">({{ $cars->total() }})</span></p>
        <div>
            <input type="text" wire:model.live='search' placeholder="{{ __('Search') }}" class="w-full h-10 mt-1 border-input-border bg-input rounded-t-md md:rounded-md md:w-96 focus:border-primary">
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full rounded-lg bg-input-border">
        <caption id="offersTableDescription" class="sr-only">{{ __('Tableau listant toutes les annonces disponibles sur AutoMarket avec des options pour modifier ou supprimer chaque annonce.') }}</caption>
            <thead>
                <tr>
                    <th class="px-6 py-3 font-medium text-left">{{ __('OfferTitle') }}</th>
                    <th class="px-6 py-3 font-medium text-left">{{ __('Type') }}</th>
                    <th class="px-6 py-3 font-medium text-left">{{ __('Seller') }}</th>
                    <th class="px-6 py-3 font-medium text-left">{{ __('PostedDate') }}</th>
                    <th class="px-6 py-3 font-medium text-right">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="bg-reverse">
                @foreach($cars as $car)
                <tr class="border-b border-input-border bg-input/80">
                    <td class="flex items-center gap-4 px-6 py-4">
                        <img class="h-10" src="{{ asset('storage/' . $car->imageDocument->document_content) }}" alt="Photo de profil">
                        <div class="text-sm font-medium text-default/80">{{ $car->carModel->brand->brand_name }} {{ $car->carModel->model_name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-2 text-xs font-semibold {{ $car->vente_enchere ? 'text-blue-800 bg-blue-100' : 'text-green-800 bg-green-100' }} rounded-full">
                            {{ $car->vente_enchere ? __('Auction') : __('Sale') }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-default/80">{{ $car->user->first_name }} {{ $car->user->last_name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-default/80">{{ \Carbon\Carbon::parse($car->created_at)->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium border rounded-md text-default/80 border-input-border hover:bg-default/5" id="options-menu">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div x-cloak x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 rounded-md shadow-lg bg-input ring-1 ring-black ring-opacity-5" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                                <div class="py-1" role="menu">
                                    <a href="{{ route('produit.index', $car->id) }}" class="block px-4 py-2 text-sm text-default/80 hover:bg-default/5" role="menuitem">{{ __('ViewOffer') }}</a>
                                    <a href="{{ route('produit.index', ['id' => $car->id, 'from' => 'admin']) }}" class="block px-4 py-2 text-sm text-default/80 hover:bg-default/5" role="menuitem">{{ __('EditOffer') }}</a>
                                    <button wire:click="deleteOffer({{ $car->id }})" class="block w-full px-4 py-2 text-sm text-left text-red-500 hover:bg-default/5" role="menuitem">{{ __('DeleteOffer') }}</button>
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