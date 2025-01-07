<div x-data="{ open: false }" @open-offer-modal.window="open = true" @close-offer-modal.window="open = false" class="w-full">
    <button @click="open = true" class="w-full px-4 py-2 mt-4 text-white rounded-lg bg-primary-500 hover:bg-primary-400">Faire une offre</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-circle-exclamation"></i>
                <p class="text-xl font-medium">Faire une offre</p>
            </div>
            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label for="proposedPrice" class="block text-sm font-medium text-gray-700">Prix proposé</label>
                    <input type="number" id="proposedPrice" wire:model="proposedPrice" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('proposedPrice') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary-500 hover:bg-primary-600">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>