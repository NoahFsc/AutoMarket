<div x-data="{ open: false, critair_id: @entangle('critair_id') }" @open-manage-critair-modal.window="open = true; critair_id = $event.detail.critair_id; $wire.openModal(critair_id)" @close-manage-critair-modal.window="open = false">
    <button @click="open = true; $wire.openModal()" class="px-4 py-2 text-white rounded-md bg-primary-500 hover:bg-primary-600"><i class="fa-solid fa-plus"></i> Ajouter un Crit'Air</button>

    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-plus"></i>
                <p class="text-xl font-medium" x-text="critair_id ? 'Modifier le Crit\'Air' : 'Ajouter un Crit\'Air'"></p>
            </div>
            <form wire:submit.prevent="saveCritair" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="nom" wire:model="nom" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('nom') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" wire:model="image" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" alt="Crit'Air Image" class="mt-2">
                    @endif
                    @error('image') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary-500 hover:bg-primary-600" x-text="critair_id ? 'Modifier' : 'Ajouter'"></button>
                </div>
            </form>
        </div>
    </div>
</div>