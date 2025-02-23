@extends('layout')

@section('titre', __('Login'))

@section('contenu')

<div class="flex flex-col mx-8 md:w-1/3 md:mx-auto">
    <div class="w-full text-2xl font-bold md:text-4xl">{{ __('Login') }}</div>
    <form action="{{ route('auth.login') }}" method="POST" class="flex flex-col w-full gap-4 md:gap-7">

        @csrf

        <div>
            <span class="text-default/50">{{ __('DontHaveAccount') }}</span>
            <a href="{{ route('auth.register') }}" class="underline text-info">{{ __('Register') }}</a>
        </div>

        <div class="flex flex-col md:gap-3">
            <div class="flex flex-col">
                <label for="email" class="mb-1 text-sm text-default/50">{{ __('EmailAddress') }}</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="{{ __('EnterEmail') }}">
                @error('email')
                    <div class="text-sm text-error">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="flex flex-col">
                <label for="password" class="mb-1 text-sm text-default/50">{{ __('Password') }}</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="{{ __('EnterPassword') }}">
                    <i class="absolute transform -translate-y-1/2 cursor-pointer text-default/50 fa-regular fa-eye right-3 top-1/2" id="togglePassword"></i>
                </div>
                @error('password')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
                <div class="flex items-center justify-between w-full mt-2">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember" class="size-4">
                        <label for="remember" class="text-sm">{{ __('RememberMe') }}</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm underline text-info">{{ __('ForgotPassword') }}</a>
                </div>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary md:hover:bg-opacity-80 focus:outline-none">{{ __('LoginButton') }}</button>

    </form>
    
    <!-- Séparateur -->
    <div class="flex items-center my-4">
        <div class="flex-grow border-t-2 border-gray-300"></div>
        <span class="mx-2 text-sm text-default/50">{{ __('Or') }}</span>
        <div class="flex-grow border-t-2 border-gray-300"></div>
    </div>

    <!-- Boutons de connexion sociale -->
    <div class="flex gap-2">
        <a href="{{ route('auth.login', ['provider' => 'google']) }}" class="flex items-center justify-center w-full px-4 py-2 text-sm text-white bg-red-500 rounded-md md:duration-300 md:transition-all md:hover:bg-red-400 focus:outline-none">
            <i class="mr-2 fab fa-google"></i> {{ __('Google') }}
        </a>
        <a href="{{ route('auth.login', ['provider' => 'apple']) }}" class="flex items-center justify-center w-full px-4 py-2 text-sm text-white bg-black rounded-md md:duration-300 md:transition-all md:hover:bg-gray-800 focus:outline-none">
            <i class="mr-2 fab fa-apple"></i> {{ __('Apple') }}
        </a>
    </div>
</div>

{{-- Gestion du champ mdp --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                const passwordField = document.getElementById('password');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>

@endsection