<div x-data="{ open: false, fuel_type_id: @entangle('fuel_type_id') }" @open-manage-fuel-type-modal.window="open = true; fuel_type_id = $event.detail.fuel_type_id; $wire.openModal(fuel_type_id)" @close-manage-fuel-type-modal.window="open = false">
    <button @click="open = true; $wire.openModal()" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-80"><i class="fa-solid fa-plus"></i> Ajouter un type de carburant</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 rounded-lg shadow-lg bg-input" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-plus"></i>
                <p class="text-xl font-medium" x-text="fuel_type_id ? 'Modifier le type de carburant' : 'Ajouter un type de carburant'"></p>
            </div>
            <form wire:submit.prevent="saveFuelType">
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-default/50">Type de carburant</label>
                    <input type="text" id="nom" wire:model="nom" class="w-full mt-1 rounded-md shadow-sm border-input-border bg-background focus:border-primary">
                    @error('nom') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80" x-text="fuel_type_id ? 'Modifier' : 'Ajouter'"></button>
                </div>
            </form>
        </div>
    </div>
</div>