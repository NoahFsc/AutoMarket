@extends('layout')

@section('titre', 'Réinitialiser le mot de passe')

@section('contenu')

<div class="flex flex-col mx-8 md:w-1/3 md:mx-auto">
    <div class="w-full mb-1 text-2xl font-bold text-center md:text-4xl">Définir un nouveau mot de passe</div>
    <div class="w-full text-base text-center text-default/50">Doit faire au minimum 8 caractères dont un spécial</div>
    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col w-full gap-2 mt-4 md:mt-6">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

        <div class="flex flex-col">
            <label for="password" class="mb-1 text-sm text-default/50">Mot de passe</label>
            <div class="relative">
                <input type="password" name="password" id="password" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="Entrez votre mot de passe" required>
                <i class="absolute transform -translate-y-1/2 cursor-pointer text-default/50 fa-regular fa-eye right-3 top-1/2" id="togglePassword"></i>
            </div>
            @error('password')
                <div class="text-sm text-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="password_confirmation" class="mb-1 text-sm text-default/50">Confirmation</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input focus:outline-none" placeholder="Confirmez votre mot de passe" required>
                <i class="absolute transform -translate-y-1/2 cursor-pointer text-default/50 fa-regular fa-eye right-3 top-1/2" id="togglePasswordConfirmation"></i>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary md:hover:bg-opacity-80 focus:outline-none">Réinitialiser le mot de passe</button>
    </form>

    <div class="mt-2 text-center">
        <a href="{{ route('auth.login') }}" class="text-sm text-default/50 hover:text-default/80">
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