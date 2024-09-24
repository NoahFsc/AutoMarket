@extends('layout')

@section('titre', 'Menu Principal')

@section('contenu')

<nav class="p-4 bg-gray-800">
    <div class="container flex items-center justify-between mx-auto">
        <div class="text-2xl text-white">VroumVroum 🚗💨</div>
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="text-white hover:text-gray-400">Accueil</a>
            <a href="{{ route('home') }}" class="text-white hover:text-gray-400">À propos</a>
            <a href="{{ route('home') }}" class="text-white hover:text-gray-400">Contact</a>
        </div>
        <div class="flex gap-4">
            @auth
                <span class="flex items-center">
                    <span class="w-3 h-3 mr-2 bg-green-500 rounded-full"></span>
                    <span class="text-white">{{ Auth::user()->name }}</span>
                </span>
                <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none">Déconnexion</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('auth.login') }}" class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-500 focus:outline-none">Connexion</a>
            @endguest
        </div>
    </div>
</nav>

<div class="container mx-auto mt-8">
    @auth
        <div class="mt-4 text-2xl">Bienvenue <b>{{ Auth::user()->name }}</b> 👋,</div>
        <p class="w-1/2 mt-4">
            Nous sommes ravis de vous accueillir sur VroumVroum.
        </p>
    @endauth

    @guest
        <div class="mt-4 text-2xl">Bienvenue sur notre site web 👋,</div>
        <p class="w-1/2 mt-4">
            Nous sommes ravis de vous accueillir. Veuillez vous inscrire ou vous connecter pour profiter de toutes les fonctionnalités !
        </p>
    @endguest
</div>

@endsection