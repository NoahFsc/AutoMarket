@extends('layout')

@section('titre', 'Connexion')

@section('contenu')

<a href="{{ route('home') }}" class="px-4 py-2 text-white bg-slate-600 rounded-md hover:bg-slate-500 focus:outline-none">Retour</a>

<div class="text-2xl mt-4">Se connecter</div>
<form action="{{ route('auth.login') }}" method="POST" class="flex flex-col gap-3">

    @csrf

    <div class="flex flex-col mt-2 mb-2">
        <label for="email" class="mb-2 text-sm font-medium text-white">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="px-3 py-2 rounded-md focus:outline-none text-black w-64" placeholder="Entrez un email">
        @error('email')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col">
        <label for="password" class="mb-2 text-sm font-medium text-white">Mot de passe</label>
        <input type="password" name="password" id="password" class="px-3 py-2 rounded-md focus:outline-none text-black w-64" placeholder="Entrez un mot de passe">
        @error('password')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <div class="flex justify-between mt-2 w-64">
            <a href="{{ route('password.request') }}" class="text-blue-500 underline">Mot de passe oublié ?</a>
            <a href="{{ route('auth.register') }}" class="text-blue-500 underline">S'inscrire</a>
        </div>
    </div>

    <div class="flex items-center mb-2">
        <input type="checkbox" name="remember" id="remember" class="mr-2">
        <label for="remember" class="text-sm text-white">Se souvenir de moi</label>
    </div>

    <div>
        <button type="submit" class="px-4 py-2 text-white bg-slate-600 rounded-md hover:bg-slate-500 focus:outline-none">Se connecter</button>
    </div>

</form>

@endsection