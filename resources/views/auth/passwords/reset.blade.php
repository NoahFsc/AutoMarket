@extends('layout')

@section('titre', 'Réinitialiser le mot de passe')

@section('contenu')

<div class="flex flex-col mx-8">
    <div class="w-full mb-1 text-2xl font-bold text-center">Définir un nouveau mot de passe</div>
    <div class="w-full text-base text-center text-gray-500">Doit faire au minimum 8 caractères dont un spécial</div>
    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col w-full gap-4 mt-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="flex flex-col">
            <label for="email" class="mb-1 text-sm text-gray-500">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre email" required>
            @error('email')
                <div class="text-error-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="password" class="mb-1 text-sm text-gray-500">Mot de passe</label>
            <div class="relative">
                <input type="password" name="password" id="password" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre mot de passe" required>
                <i class="absolute text-gray-500 transform -translate-y-1/2 cursor-pointer fa-regular fa-eye right-3 top-1/2" id="togglePassword"></i>
            </div>
            @error('password')
                <div class="text-error-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="password_confirmation" class="mb-1 text-sm text-gray-500">Confirmation</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Confirmez votre mot de passe" required>
                <i class="absolute text-gray-500 transform -translate-y-1/2 cursor-pointer fa-regular fa-eye right-3 top-1/2" id="togglePasswordConfirmation"></i>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary-500 md:hover:bg-primary-400 focus:outline-none">Réinitialiser le mot de passe</button>
    </form>

    <div class="mt-2 text-center">
        <a href="{{ route('auth.login') }}" class="text-sm text-gray-400 hover:text-gray-500">
            <i class="mr-1 fa-solid fa-arrow-left fa-sm"></i> Retour vers la connexion
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');

        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                const passwordField = document.getElementById('password');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        if (togglePasswordConfirmation) {
            togglePasswordConfirmation.addEventListener('click', function () {
                const passwordField = document.getElementById('password_confirmation');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>

@endsection