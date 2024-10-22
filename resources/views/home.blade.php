@extends('layout')

@section('titre', 'Menu Principal')

@section('contenu')

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