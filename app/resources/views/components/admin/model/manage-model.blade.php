<div x-data="{ open: false, model_id: @entangle('model_id') }" @open-manage-model-modal.window="open = true; model_id = $event.detail.model_id; $wire.openModal(model_id)" @close-manage-model-modal.window="open = false">
    <button @click="open = true; $wire.openModal()" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-80"><i class="fa-solid fa-plus"></i> Ajouter un modèle</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-plus"></i>
                <p class="text-xl font-medium" x-text="model_id ? 'Modifier le modèle' : 'Ajouter un modèle'"></p>
            </div>
            <form wire:submit.prevent="saveModel">
                <div class="mb-4">
                    <label for="model_name" class="block text-sm font-medium text-gray-700">Modèle</label>
                    <input type="text" id="model_name" wire:model="model_name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring-primary">
                    @error('model_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80" x-text="model_id ? 'Modifier' : 'Ajouter'"></button>
                </div>
            </form>
        </div>
    </div>
</div>