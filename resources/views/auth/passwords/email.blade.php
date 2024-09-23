@extends('layout')

@section('titre', 'Mot de passe oublié')

@section('contenu')

<a href="{{ route('home') }}" class="px-4 py-2 text-white bg-slate-600 rounded-md hover:bg-slate-500 focus:outline-none">Retour</a>

<div class="text-2xl mt-4">Réinitialiser le mot de passe</div>
<form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-3 mt-4">
    @csrf

    <div class="flex flex-col mt-2 mb-2">
        <label for="email" class="mb-2 text-sm font-medium text-white">Adresse e-mail</label>
        <input type="email" name="email" id="email" class="px-3 py-2 rounded-md focus:outline-none text-black w-64" placeholder="Entrez votre email" required>
        @error('email')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit" class="px-4 py-2 text-white bg-slate-600 rounded-md hover:bg-slate-500 focus:outline-none">Envoyer le lien de réinitialisation</button>
    </div>
</form>

@endsection