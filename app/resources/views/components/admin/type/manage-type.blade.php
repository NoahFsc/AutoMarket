<div x-data="{ open: false, vehicle_type_id: @entangle('type_of_car_id') }" @open-manage-type-modal.window="open = true; vehicle_type_id = $event.detail.vehicle_type_id; $wire.openModal(vehicle_type_id)" @close-manage-type-modal.window="open = false">
    <button @click="open = true; $wire.openModal()" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-80"><i class="fa-solid fa-plus"></i> Ajouter un type de véhicule</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 rounded-lg shadow-lg bg-input" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-plus"></i>
                <p class="text-xl font-medium" x-text="vehicle_type_id ? 'Modifier le type de véhicule' : 'Ajouter un type de véhicule'"></p>
            </div>
            <form wire:submit.prevent="saveType">
                <div class="mb-4">
                    <label for="segment" class="block text-sm font-medium text-default/50">Segment</label>
                    <input type="text" id="segment" wire:model="segment" class="w-full mt-1 rounded-md shadow-sm border-input-border bg-background focus:border-primary">
                    @error('segment') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-default/50">Nom</label>
                    <input type="text" id="nom" wire:model="nom" class="w-full mt-1 rounded-md shadow-sm border-input-border bg-background focus:border-primary">
                    @error('nom') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80" x-text="vehicle_type_id ? 'Modifier' : 'Ajouter'"></button>
                </div>
            </form>
        </div>
    </div>
</div>
