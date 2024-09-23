@extends('layout')

@section('titre', 'Menu Principal')

@section('contenu')

<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-2xl">VroumVroum 🚗💨</div>
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="text-white hover:text-gray-400">Accueil</a>
            <a href="{{ route('home') }}" class="text-white hover:text-gray-400">À propos</a>
            <a href="{{ route('home') }}" class="text-white hover:text-gray-400">Contact</a>
        </div>
        <div class="flex gap-4">
            @auth
                <span class="flex items-center">
                    <span class="h-3 w-3 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-white">{{ Auth::user()->name }}</span>
                </span>
                <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none">Déconnexion</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('auth.login') }}" class="px-4 py-2 text-white bg-slate-600 rounded-md hover:bg-slate-500 focus:outline-none">Connexion</a>
            @endguest
        </div>
    </div>
</nav>

<div class="container mx-auto mt-8">
    @auth
        <div class="text-2xl mt-4">Bienvenue <b>{{ Auth::user()->name }}</b> 👋,</div>
        <p class="w-1/2 mt-4">
            Nous sommes ravis de vous accueillir sur VroumVroum.
        </p>
    @endauth

    @guest
        <div class="text-2xl mt-4">Bienvenue sur notre site web 👋,</div>
        <p class="w-1/2 mt-4">
            Nous sommes ravis de vous accueillir. Veuillez vous inscrire ou vous connecter pour profiter de toutes les fonctionnalités !
        </p>
    @endguest
</div>

@endsection