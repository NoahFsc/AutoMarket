@extends('layout')

@section('titre', __('Register'))

@section('contenu')

<div class="flex flex-col gap-4 mx-8 md:w-1/3 md:mx-auto">
    <div class="w-full text-2xl font-bold text-center md:text-4xl">{{ __('CompleteRegistration') }}</div>
    <form action="{{ route('auth.register.step2') }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full gap-4">

        @csrf

        <div class="flex flex-col md:gap-3">
            <div class="flex flex-col md:flex-row md:gap-4">
                <div class="flex flex-col md:w-1/2">
                    <label for="birth_date" class="mb-1 text-sm text-default/50">{{ __('BirthDate') }}</label>
                    <input type="date" name="birth_date" id="birth_date" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" required>
                    @error('birth_date')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col md:w-1/2">
                    <label for="identity_card" class="mb-1 text-sm text-default/50">{{ __('IdentityCard') }}</label>
                    <input type="file" name="identity_card" id="identity_card" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" accept=".pdf,.jpg,.jpeg" required>
                    @error('identity_card')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col">
                <label for="adresse" class="mb-1 text-sm text-default/50">{{ __('Location') }}</label>
                <input type="text" name="adresse" id="adresse" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="{{ __('EnterAddress') }}" required>
                @error('adresse')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="telephone" class="mb-1 text-sm text-default/50">{{ __('PhoneNumber') }}</label>
                <input type="text" name="telephone" id="telephone" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="{{ __('EnterPhoneNumber') }}" required>
                @error('telephone')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary md:hover:bg-opacity-80 focus:outline-none">{{ __('CreateAccountButton') }}</button>

    </form>
    <div class="mt-2 text-center">
        <a href="javascript:history.back()" class="text-sm text-gray-400 hover:text-default/50">
            <i class="mr-1 fa-solid fa-arrow-left fa-sm"></i> {{ __('BackToPreviousPage') }}
        </a>
    </div>
</div>

@endsection