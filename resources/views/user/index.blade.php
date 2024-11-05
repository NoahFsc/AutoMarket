@extends('layout')

@section('titre', 'Profil')

@section('contenu')

<div class="flex flex-col gap-3 mx-8 md:w-3/4 md:mx-auto">

    <div class="flex flex-col gap-3 md:flex-row md:justify-between">
        {{-- Entête --}}
        <div>
            <div class="flex gap-4 md:flex-col md:w-1/2 md:gap-2">
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}" alt="Avatar" class="border border-white rounded-full size-20 md:size-24">
                <div class="flex flex-col w-full">
                    <span class="w-full text-2xl font-bold">{{Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                    <span class="text-base text-gray-500 md:hidden">{{ '@' . strtolower(Auth::user()->first_name . Auth::user()->last_name) }} </span>
                    <div class="flex items-baseline justify-end w-full gap-1 md:hidden">
                        <i class="text-yellow-400 fa-solid fa-star"></i>
                        <span class="text-sm font-bold">5.0</span> {{-- A changer par moyenne avis bdd --}}
                        <span class="text-sm text-gray-500">(12)</span> {{-- A changer par nb avis bdd --}}
                    </div>
                </div>
            </div>
            <span class="mt-2 text-sm">{{ Auth::user()->description ? Auth::user()->description : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.'}}</span>
        </div>

        <div class="md:flex md:flex-col md:gap-3 md:w-1/3">
            {{-- Boutons Desktop --}}
            <div class="hidden gap-3 md:flex md:justify-end">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Déconnexion</button>
                </form>
                <a href="{{ route('user.edit') }}" class="w-1/3 py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary-500 hover:bg-primary-400">Modifier le profil</a>
            </div>
        
            {{-- Données importantes --}}
            <div class="flex w-full gap-3">
                <div class="flex flex-col w-full gap-2 p-2 rounded-lg bg-opacity-20 bg-primary-500 md:p-4">
                    <span class="text-xl font-bold text-primary-500 md:text-4xl">171</span> {{-- A changer par nb annonces bdd --}}
                    <span class="text-sm">Véhicules vendus</span>
                </div>
                <div class="flex flex-col w-full gap-2 p-2 rounded-lg bg-opacity-10 bg-primary-500 md:p-4">
                    <span class="text-xl font-bold text-primary-500 md:text-4xl">{{ floor(\Carbon\Carbon::parse(Auth::user()->created_at)->diffInYears(\Carbon\Carbon::now())) }}</span>
                    <span class="text-sm">Années de présence</span>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Boutons Mobile --}}
    <div class="flex gap-3 md:hidden">
        <a href="{{ route('user.edit') }}" class="w-full py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary-500 hover:bg-primary-400">Modifier le profil</a>
        <form action="{{ route('auth.logout') }}" method="POST" class="w-full">
            @method('DELETE')
            @csrf
            <button type="submit" class="w-full py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Déconnexion</button>
        </form>
    </div>


    {{-- Informations supplémentaires --}}
    <div class="flex items-center justify-between w-full md:justify-normal md:gap-8">
        <span class="hidden text-sm text-gray-500 md:block">{{ '@' . strtolower(Auth::user()->first_name . Auth::user()->last_name) }} </span>
        <div>
            <i class="text-gray-500 fa-regular fa-location-dot fa-sm"></i>
            <span class="text-sm text-gray-500">{{ \Illuminate\Support\Str::after(Auth::user()->adresse, ',') }}</span>
        </div>
        <div>
            <i class="text-gray-500 fa-regular fa-calendar fa-sm"></i>
            <span class="text-sm text-gray-500">A rejoint le {{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d M Y') }}</span>
        </div>
        <div class="items-baseline hidden gap-1 md:flex">
            <i class="text-yellow-400 fa-solid fa-star"></i>
            <span class="text-sm font-bold">5.0</span> {{-- A changer par moyenne avis bdd --}}
            <span class="text-sm text-gray-500">(12)</span> {{-- A changer par nb avis bdd --}}
        </div>
    </div>

    {{-- Séparateur --}}
    <hr class="border-gray-300">
</div>

@endsection