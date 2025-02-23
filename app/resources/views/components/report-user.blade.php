<div x-data="{ open: false }" @open-report-modal.window="open = true" @close-report-modal.window="open = false">
    <button @click="open = true" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">{{ __('Report') }}</button>

    <div x-cloak x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click="open = false">
        <div class="w-full max-w-md p-6 rounded-lg shadow-lg bg-input" @click.stop>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-3xl fa-regular fa-circle-exclamation"></i>
                <p class="text-xl font-medium">{{ __('ReportUser') }} <span class="font-bold">{{ $user->first_name }} {{ $user->last_name }}</span></p>
            </div>
            <form wire:submit.prevent="submit">
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700">{{ __('ReasonForReport') }}</label>
                    <textarea id="reason" wire:model="reason" class="w-full mt-1 rounded-md shadow-sm border-input-border bg-input focus:border-primary focus:ring-primary"></textarea>
                    @error('reason') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="open = false" class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error border-error">{{ __('Cancel') }}</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white transition-all duration-300 rounded-lg bg-error hover:bg-error">{{ __('Report') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>