@extends('layout')

@section('titre', 'Inscription')

@section('contenu')

<a href="{{ route('home') }}" class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-500 focus:outline-none">Retour</a>

<div class="mt-4 text-2xl">S'inscrire</div>
<form action="{{ route('auth.register') }}" method="POST" class="flex flex-col gap-3">

    @csrf

    <div class="flex flex-col mt-2 mb-2">
        <label for="name" class="mb-2 text-sm font-medium text-white">Nom</label>
        <input type="text" name="name" id="name" class="w-64 px-3 py-2 text-black rounded-md focus:outline-none" placeholder="Entrez votre nom">
        @error('name')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col mb-2">
        <label for="email" class="mb-2 text-sm font-medium text-white">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="w-64 px-3 py-2 text-black rounded-md focus:outline-none" placeholder="Entrez votre email">
        @error('email')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col mb-2">
        <label for="password" class="mb-2 text-sm font-medium text-white">Mot de passe</label>
        <input type="password" name="password" id="password" class="w-64 px-3 py-2 text-black rounded-md focus:outline-none" placeholder="Entrez votre mot de passe">
        @error('password')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex flex-col mb-2">
        <label for="password_confirmation" class="mb-2 text-sm font-medium text-white">Confirmez le mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="w-64 px-3 py-2 text-black rounded-md focus:outline-none" placeholder="Confirmez votre mot de passe">
        @error('password_confirmation')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="flex items-center justify-between w-64">
        <button type="submit" class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-500 focus:outline-none">S'inscrire</button>
        <a href="{{ route('auth.login') }}" class="text-blue-500 underline">Se connecter</a>
    </div>

</form>

@endsection