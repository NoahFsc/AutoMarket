<div x-data="{ open: false, brand_id: @entangle('brand_id') }" @open-manage-brand-modal.window="open = true; brand_id = $event.detail.brand_id; $wire.openModal(brand_id)" @close-manage-brand-modal.window="open = false">
    <button @click="open = true; $wire.openModal()" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-80"><i class="fa-regular fa-plus"></i> Ajouter une marque</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 rounded-lg shadow-lg bg-input" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-plus"></i>
                <p class="text-xl font-medium" x-text="brand_id ? 'Modifier la marque' : 'Ajouter une marque'"></p>
            </div>
            <form wire:submit.prevent="saveBrand">
                <div class="mb-4">
                    <label for="brand_name" class="block text-sm font-medium text-default/50">Marque</label>
                    <input type="text" id="brand_name" wire:model="brand_name" class="w-full mt-1 rounded-md shadow-sm border-input-border bg-background focus:border-primary">
                    @error('brand_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80" x-text="brand_id ? 'Modifier' : 'Ajouter'"></button>
                </div>
            </form>
        </div>
    </div>
</div>