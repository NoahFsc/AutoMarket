@extends('layout')

@section('titre', __('ForgotPassword'))

@section('contenu')

<div class="flex flex-col mx-8 md:w-1/3 md:mx-auto">
    <div class="w-full text-2xl font-bold text-center md:text-4xl">{{ __('ForgotPasswordQuestion') }}</div>
    <div class="text-base text-center text-default/50">{{ __('ForgotPasswordInstructions') }}</div>
    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col w-full gap-4 mt-4 md:mt-6">
        @csrf

        <div class="flex flex-col">
            <label for="email" class="mb-1 text-sm text-default/50">{{ __('EmailAddress') }}</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="{{ __('EnterEmail') }}" required>
            @error('email')
                <div class="text-sm text-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary md:hover:bg-opacity-80 focus:outline-none">{{ __('SendResetLink') }}</button>
    </form>
    <div class="mt-2 text-center">
        <a href="{{ route('auth.login') }}" class="text-sm text-gray-400 hover:text-default/50">
            <i class="mr-1 fa-solid fa-arrow-left fa-sm"></i> {{ __('BackToLogin') }}
        </a>
    </div>
</div>

@endsection