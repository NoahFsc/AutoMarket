@extends('layout')

@section('titre', 'Inscription')

@section('contenu')

<div class="flex flex-col gap-4 mx-8 md:w-1/3 md:mx-auto">
    <div class="w-full text-2xl font-bold text-center md:text-4xl">Compléter votre inscription</div>
    <form action="{{ route('auth.register.step2') }}" method="POST" enctype="multipart/form-data" class="flex flex-col w-full gap-4">

        @csrf

        <div class="flex flex-col md:gap-3">
            <div class="flex flex-col md:flex-row md:gap-4">
                <div class="flex flex-col md:w-1/2">
                    <label for="birth_date" class="mb-1 text-sm text-gray-500">Date de naissance</label>
                    <input type="date" name="birth_date" id="birth_date" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" required>
                    @error('birth_date')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex flex-col md:w-1/2">
                    <label for="identity_card" class="mb-1 text-sm text-gray-500">Carte d'identité (PDF, JPG)</label>
                    <input type="file" name="identity_card" id="identity_card" class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-md focus:outline-none" accept=".pdf,.jpg,.jpeg" required>
                    @error('identity_card')
                        <div class="text-sm text-red-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col">
                <label for="adresse" class="mb-1 text-sm text-gray-500">Localisation</label>
                <input type="text" name="adresse" id="adresse" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre adresse" required>
                @error('adresse')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="telephone" class="mb-1 text-sm text-gray-500">Numéro de téléphone</label>
                <input type="text" name="telephone" id="telephone" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre numéro de téléphone" required>
                @error('telephone')
                    <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="px-4 py-2 text-sm text-white rounded-md md:duration-300 md:transition-all bg-primary-500 md:hover:bg-primary-400 focus:outline-none">Créer un compte</button>

    </form>
    <div class="mt-2 text-center">
        <a href="javascript:history.back()" class="text-sm text-gray-400 hover:text-gray-500">
            <i class="mr-1 fa-solid fa-arrow-left fa-sm"></i> Retour à la page précédente
        </a>
    </div>
</div>

@endsection