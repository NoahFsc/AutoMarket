<div class="relative flex flex-col flex-grow gap-4 mt-16 mr-16">

    {{-- Entête --}}
    <div class="flex flex-col">
        <p class="text-2xl font-medium">Gestion des signalements</p>
        <p class="text-lg font-medium opacity-50">Gérez les signalements des utilisateurs</p>
    </div>

    {{-- Barre d'outils --}}
    <div class="flex items-end justify-between">
        <p class="font-medium">Tous les signalements <span class="font-medium opacity-50">({{ $reports->total() }})</span></p>
        <div>
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full h-10 mt-1 border-gray-300 rounded-t-md md:rounded-md md:w-96 focus:border-primary focus:ring-primary">
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-300 rounded-lg">
            <thead>
                <tr>
                    <th class="px-6 py-3 font-medium text-left">Utilisateur concerné</th>
                    <th class="px-6 py-3 font-medium text-left">Envoyé par</th>
                    <th class="px-6 py-3 font-medium text-left">Message</th>
                    <th class="px-6 py-3 font-medium text-left">Statut</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($reports as $report)
                <tr class="border-b border-gray-300">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <img class="rounded-full size-10" src="{{ $report->receiver->profile_picture ? asset('storage/' . $report->receiver->profile_picture) : asset('assets/default_pfp.png') }}" alt="Photo de profil">
                            <div>
                                <a href="{{ route('user.index', $report->receiver->id) }}">
                                    <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $report->receiver->first_name }} {{ $report->receiver->last_name }}</div>
                                </a>
                                <div class="text-sm text-gray-500">{{ $report->receiver->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <img class="rounded-full size-10" src="{{ $report->writer->profile_picture ? asset('storage/' . $report->writer->profile_picture) : asset('assets/default_pfp.png') }}" alt="Photo de profil">
                            <div>
                                <a href="{{ route('user.index', $report->writer->id) }}">
                                    <div class="text-sm font-medium text-gray-900 hover:text-primary">{{ $report->writer->first_name }} {{ $report->writer->last_name }}</div>
                                </a>
                                <div class="text-sm text-gray-500">{{ $report->writer->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $report->reason }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-2 text-xs font-semibold {{ $report->status ? 'text-green-800 bg-green-100' : 'text-yellow-800 bg-yellow-100' }} rounded-full">
                            {{ $report->status ? 'Traité' : 'En traitement' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50" id="options-menu">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div x-cloak x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                                <div class="py-1" role="menu">
                                    <button wire:click="markAsResolved({{ $report->id }})" class="block w-full px-4 py-2 text-sm text-left text-green-500 hover:bg-gray-100" role="menuitem">Marquer comme traité</button>
                                    <button wire:click="markAsUnresolved({{ $report->id }})" class="block w-full px-4 py-2 text-sm text-left text-yellow-500 hover:bg-gray-100" role="menuitem">Marquer comme en traitement</button>
                                    <button wire:click="deleteReport({{ $report->id }})" class="block w-full px-4 py-2 text-sm text-left text-red-500 hover:bg-gray-100" role="menuitem">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $reports->links('components.pagination') }}
        </div>
    </div>
</div>