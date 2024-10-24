@extends('layout')

@section('titre', 'Connexion')

@section('contenu')

<div class="flex flex-col mx-8">
    <div class="w-full text-2xl font-bold">Connexion</div>
    <form action="{{ route('auth.login') }}" method="POST" class="flex flex-col w-full gap-4">

        @csrf

        <div>
            <span class="text-gray-500">Vous n'avez pas de compte ?</span>
            <a href="{{ route('auth.register') }}" class="underline text-info-500">S'inscrire</a>
        </div>

        <div class="flex flex-col">
            <label for="email" class="mb-1 text-sm text-gray-500">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez un email">
            @error('email')
                <div class="text-error-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="password" class="mb-1 text-sm text-gray-500">Mot de passe</label>
            <div class="relative">
                <input type="password" name="password" id="password" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez un mot de passe">
                <i class="absolute text-gray-500 transform -translate-y-1/2 cursor-pointer fa-regular fa-eye right-3 top-1/2" id="togglePassword"></i>
            </div>
            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <div class="flex items-center justify-between w-full mt-2">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="size-4">
                    <label for="remember" class="text-sm">Se souvenir de moi</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm underline text-info-500">Mot de passe oublié ?</a>
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary-500 md:hover:bg-primary-400 focus:outline-none">Se connecter</button>

    </form>
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