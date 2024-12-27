<div x-data="{ open: false }" @open-report-modal.window="open = true" @close-report-modal.window="open = false">
    <button @click="open = true" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Signaler</button>

    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-circle-exclamation"></i>
                <p class="text-xl font-medium">Signaler <span class="font-bold">{{ $user->first_name }} {{ $user->last_name }}</span></p>
            </div>
            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700">Raison du signalement</label>
                    <textarea id="reason" wire:model="reason" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500"></textarea>
                    @error('reason') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Annuler</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-error-500 hover:bg-error-600">Signaler</button>
                </div>
            </form>
        </div>
    </div>
</div>