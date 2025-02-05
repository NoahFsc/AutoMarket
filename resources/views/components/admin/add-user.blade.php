<div x-data="{ open: false }" @open-add-user-modal.window="open = true" @close-add-user-modal.window="open = false">
    <button @click="open = true" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-80"><i class="fa-solid fa-user-plus"></i> Ajouter un utilisateur</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-user-plus"></i>
                <p class="text-xl font-medium">Ajouter un utilisateur</p>
            </div>
            <form wire:submit.prevent="addUser">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" id="first_name" wire:model="first_name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                    @error('first_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="last_name" wire:model="last_name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                    @error('last_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                    <input type="email" id="email" wire:model="email" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                    @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" id="password" wire:model="password" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                    @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

