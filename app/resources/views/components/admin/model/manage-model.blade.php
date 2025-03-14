<div x-data="{ open: false, model_id: @entangle('model_id') }" @open-manage-model-modal.window="open = true; model_id = $event.detail.model_id; $wire.openModal(model_id)" @close-manage-model-modal.window="open = false">
    <button @click="open = true; $wire.openModal()" class="px-4 py-2 text-white rounded-md bg-primary hover:bg-opacity-80"><i class="fa-solid fa-plus"></i> {{ __('AddModel') }}</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 rounded-lg shadow-lg bg-input" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-plus"></i>
                <p class="text-xl font-medium" x-text="model_id ? '{{ __('EditModel') }}' : '{{ __('AddModel') }}'"></p>
            </div>
            <form wire:submit.prevent="saveModel">
                <div class="mb-4">
                    <label for="model_name" class="block text-sm font-medium text-default/50">{{ __('Model') }}</label>
                    <input type="text" id="model_name" wire:model="model_name" class="w-full mt-1 rounded-md shadow-sm border-input-border bg-background focus:border-primary">
                    @error('model_name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">{{ __('Cancel') }}</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80" x-text="model_id ? '{{ __('Edit') }}' : '{{ __('Add') }}'"></button>
                </div>
            </form>
        </div>
    </div>
</div>