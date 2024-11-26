@extends('layout')

@section('titre', 'Inscription')

@section('contenu')

<div class="flex flex-col mx-8 md:w-1/3 md:mx-auto">
    <div class="w-full text-2xl font-bold md:text-4xl">Créer un compte</div>
    <form action="{{ route('auth.register') }}" method="POST" class="flex flex-col w-full gap-4 md:gap-7">

        @csrf

        <div>
            <span class="text-gray-500">Vous avez déjà un compte ?</span>
            <a href="{{ route('auth.login') }}" class="underline text-info-500">Se connecter</a>
        </div>

        <div class="flex flex-col md:gap-3">
            <div class="flex flex-col md:flex-row md:gap-3">
                <div class="flex flex-col w-full md:w-1/2">
                    <label for="first_name" class="mb-1 text-sm text-gray-500">Prénom</label>
                    <input type="text" name="first_name" id="first_name" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre prénom">
                    @error('first_name')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col w-full md:w-1/2">
                    <label for="last_name" class="mb-1 text-sm text-gray-500">Nom</label>
                    <input type="text" name="last_name" id="last_name" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre nom">
                    @error('last_name')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col">
                <label for="email" class="mb-1 text-sm text-gray-500">Adresse e-mail</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre email">
                @error('email')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="password" class="mb-1 text-sm text-gray-500">Mot de passe</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre mot de passe">
                    <i class="absolute text-gray-500 transform -translate-y-1/2 cursor-pointer fa-regular fa-eye right-3 top-1/2" id="togglePassword"></i>
                </div>
                @error('password')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="password_confirmation" class="mb-1 text-sm text-gray-500">Confirmation</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Confirmez votre mot de passe">
                    <i class="absolute text-gray-500 transform -translate-y-1/2 cursor-pointer fa-regular fa-eye right-3 top-1/2" id="togglePasswordConfirmation"></i>
                </div>
                @error('password_confirmation')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary-500 md:hover:bg-primary-400 focus:outline-none">Créer un compte</button>

    </form>
    
    <!-- Séparateur -->
    <div class="flex items-center my-4">
        <div class="flex-grow border-t-2 border-gray-300"></div>
        <span class="mx-2 text-sm text-gray-500">Ou</span>
        <div class="flex-grow border-t-2 border-gray-300"></div>
    </div>

    <!-- Boutons de connexion sociale -->
    <div class="flex gap-2">
        <a href="{{ route('auth.login', ['provider' => 'google']) }}" class="flex items-center justify-center w-full px-4 py-2 text-sm text-white bg-red-500 rounded-md md:duration-300 md:transition-all md:hover:bg-red-400 focus:outline-none">
            <i class="mr-2 fab fa-google"></i> Google
        </a>
        <a href="{{ route('auth.login', ['provider' => 'apple']) }}" class="flex items-center justify-center w-full px-4 py-2 text-sm text-white bg-black rounded-md md:duration-300 md:transition-all md:hover:bg-gray-800 focus:outline-none">
            <i class="mr-2 fab fa-apple"></i> Apple
        </a>
    </div>
</div>

{{-- Gestion du champ mdp --}}
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