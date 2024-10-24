@extends('layout')

@section('titre', 'Profil')

@section('contenu')

<div class="flex flex-col gap-3 mx-8 md:w-1/3 md:mx-auto">

    {{-- Entête --}}
    <div>
        <div class="flex gap-4">
            <img src="{{ Auth::user()->photo_de_profil ? asset('storage/' . Auth::user()->photo_de_profil) : asset('assets/default_pfp.png') }}" alt="Avatar" class="border-4 border-white rounded-full size-20">
            <div class="flex flex-col w-full">
                <span class="w-full text-2xl font-bold md:text-4xl">{{Auth::user()->prenom . ' ' . Auth::user()->nom }}</span>
                <span class="text-base text-gray-500">{{ '@' . strtolower(Auth::user()->prenom . Auth::user()->nom) }} </span>
                <div class="flex items-baseline justify-end w-full gap-1">
                    <i class="text-yellow-400 fa-solid fa-star"></i>
                    <span class="text-sm font-bold">5.0</span> {{-- A changer par moyenne avis bdd --}}
                    <span class="text-sm text-gray-500">(12)</span> {{-- A changer par nb avis bdd --}}
                </div>
            </div>
        </div>
        <span class="mt-2 text-sm">{{ Auth::user()->description ? Auth::user()->description : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.'}}</span>
    </div>

    {{-- Données importantes --}}
    <div class="flex w-full gap-3">
        <div class="flex flex-col w-full gap-2 p-2 rounded-lg bg-opacity-20 bg-primary-500">
            <span class="text-xl font-bold text-primary-500">171</span> {{-- A changer par nb annonces bdd --}}
            <span class="text-sm">Véhicules vendus</span>
        </div>
        <div class="flex flex-col w-full gap-2 p-2 rounded-lg bg-opacity-10 bg-primary-500">
            <span class="text-xl font-bold text-primary-500">{{ floor(\Carbon\Carbon::parse(Auth::user()->created_at)->diffInYears(\Carbon\Carbon::now())) }}</span>
            <span class="text-sm">Années de présence</span>
        </div>
    </div>

    {{-- Boutons --}}
    <div class="flex gap-3">
        <a href="{{ route('user.edit') }}" class="w-full py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary-500 hover:bg-primary-400">Modifier le profil</a>
        <form action="{{ route('auth.logout') }}" method="POST" class="w-full">
            @method('DELETE')
            @csrf
            <button type="submit" class="w-full py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Déconnexion</button>
        </form>
    </div>

    {{-- Informations supplémentaires --}}
    <div class="flex justify-between w-full">
        <div>
            <i class="text-gray-500 fa-regular fa-location-dot fa-sm"></i>
            <span class="text-sm text-gray-500">{{ \Illuminate\Support\Str::after(Auth::user()->localisation, ',') }}</span>
        </div>
        <div>
            <i class="text-gray-500 fa-regular fa-calendar fa-sm"></i>
            <span class="text-sm text-gray-500">A rejoint le {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y') }}</span>
        </div>
    </div>

    {{-- Séparateur --}}
    <hr class="border-gray-300">
</div>

@endsection