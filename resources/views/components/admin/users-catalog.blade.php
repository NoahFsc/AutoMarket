<div class="relative flex flex-col flex-grow gap-4 mr-16">

    {{-- Entête --}}
    <div class="flex flex-col">
        <p class="text-2xl font-medium">Gestion des utilisateurs</p>
        <p class="text-lg font-medium opacity-50">Gérez les comptes des vendeurs et acheteurs</p>
    </div>

    {{-- Barre d'outils --}}
    <div class="flex items-end justify-between">
        <p class="font-medium">Tous les utilisateurs <span class="font-medium opacity-50">({{ $users->total() }})</span></p>
        <div>
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="w-full h-10 mt-1 border-gray-300 rounded-t-md md:rounded-md md:w-96 focus:border-primary-500 focus:ring-primary-500">
            <button class="px-4 py-2 ml-2 text-white rounded-md bg-primary-500 hover:bg-primary-600" wire:click="addUser"><i class="fa-solid fa-user-plus"></i> Ajouter un utilisateur</button>
        </div>
    </div>

    {{-- Tableau --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-300 rounded-lg">
            <thead>
                <tr>
                    <th class="px-6 py-3 font-medium text-left">Utilisateur</th>
                    <th class="px-6 py-3 font-medium text-left">Rôle</th>
                    <th class="px-6 py-3 font-medium text-left">Dernière activité</th>
                    <th class="px-6 py-3 font-medium text-left">Date de création</th>
                    <th class="px-6 py-3 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($users as $user)
                <tr class="border-b border-gray-300">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <img class="rounded-full size-10" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/default_pfp.png') }}" alt="Photo de profil">
                            <div>
                                <a href="{{ route('user.index', $user->id) }}">
                                    <div class="text-sm font-medium text-gray-900 hover:text-primary-500">{{ $user->first_name }} {{ $user->last_name }}</div>
                                </a>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->is_admin)
                            <span class="inline-flex px-2 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Administrateur</span>
                        @elseif($user->email_verified_at)
                            <span class="inline-flex px-2 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">Vérifié</span>
                        @else
                            <span class="inline-flex px-2 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Non vérifié</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $user->updated_at->diffForHumans(['locale' => 'fr']) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-right">
                        <div class="relative inline-block text-left" x-data="{ open: false }">
                            <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50" id="options-menu">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                                <div class="py-1" role="menu">
                                    <a href="{{ route('user.index', $user->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Voir le profil</a>
                                    <a href="{{ route('user.edit', ['id' => $user->id, 'from' => 'admin']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Modifier le compte</a>
                                    <button wire:click="deleteUser({{ $user->id }})" class="block w-full px-4 py-2 text-sm text-left text-red-500 hover:bg-gray-100" role="menuitem">Supprimer le compte</button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links('components.pagination') }}
        </div>
    </div>
</div>