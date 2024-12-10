@extends('layout')

@section('titre', 'Profil')

@section('contenu')

<div class="flex flex-col gap-3 mx-8 md:w-3/4 md:mx-auto">

    <div class="flex flex-col gap-3 md:flex-row md:justify-between">
        {{-- Entête --}}
        <div class="flex flex-col flex-grow">
            <div class="flex gap-4 md:flex-col md:w-1/2 md:gap-2">
                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/default_pfp.png') }}" alt="Avatar" class="rounded-full size-20 md:size-24">
                <div class="flex flex-col w-full">
                    <span class="w-full text-2xl font-medium">{{$user->first_name . ' ' . $user->last_name }}</span>
                    <span class="text-base text-gray-500 md:hidden">{{ '@' . strtolower($user->first_name . $user->last_name) }} </span>
                    <div class="flex items-baseline justify-end w-full gap-1 md:hidden">
                        <i class="text-yellow-400 fa-solid fa-star"></i>
                        <span class="text-sm font-bold">{{ number_format($reviews->avg('nb_of_star'), 1) }}</span>
                        <span class="text-sm text-gray-500">({{ count($reviews) }})</span>
                    </div>
                </div>
            </div>
            <span class="w-full mt-2 text-sm opacity-50">{{ $user->description ? $user->description : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.'}}</span>
        </div>

        <div class="md:flex md:flex-col md:gap-3 md:w-1/3">
            {{-- Boutons Desktop --}}
            @if ($user->id == Auth::id())
            <div class="hidden gap-3 md:flex md:justify-end">
                @if ($user->is_admin == 1)
                <a href="{{ route('admin.dashboard') }}" class="p-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-error-500 hover:bg-error-400">Dashboard</a>
                @endif
                <form action="{{ route('auth.logout') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Déconnexion</button>
                </form>
                <a href="{{ route('user.edit') }}" class="w-1/3 py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary-500 hover:bg-primary-400">Modifier le profil</a>
            </div>
            @else
            <div class="hidden gap-3 md:flex md:justify-end">
                <a href="{{ route('user.show', $user->id) }}"class="px-4 py-2 text-sm transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Signaler</a>
                <a href="{{ route('user.show', $user->id) }}" class="w-1/3 py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary-500 hover:bg-primary-400">Envoyer un message</a>
            </div>
            @endif
        
            {{-- Données importantes --}}
            <div class="flex w-full gap-3">
                <div class="flex flex-col w-full gap-2 p-2 rounded-lg bg-opacity-20 bg-primary-500 md:p-4">
                    <span class="text-xl font-bold text-primary-500 md:text-4xl"> {{ count($cars->where('status', 1)) }} </span>
                    <span class="text-sm">Véhicules vendus</span>
                </div>
                <div class="flex flex-col w-full gap-2 p-2 rounded-lg bg-opacity-10 bg-primary-500 md:p-4">
                    <span class="text-xl font-bold text-primary-500 md:text-4xl">{{ floor(\Carbon\Carbon::parse($user->created_at)->diffInYears(\Carbon\Carbon::now())) }}</span>
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
        <span class="hidden text-sm text-gray-500 md:block">{{ '@' . strtolower($user->first_name . $user->last_name) }} </span>
        <div>
            <i class="text-gray-500 fa-regular fa-location-dot fa-sm"></i>
            <span class="text-sm text-gray-500">{{ \Illuminate\Support\Str::after($user->adresse, ',') }}</span>
        </div>
        <div>
            <i class="text-gray-500 fa-regular fa-calendar fa-sm"></i>
            <span class="text-sm text-gray-500">A rejoint le {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
        </div>
        <div class="items-baseline hidden gap-1 md:flex">
            <i class="text-yellow-400 fa-solid fa-star"></i>
            <span class="text-sm font-bold">{{ number_format($reviews->avg('nb_of_star'), 1) }}</span>
            <span class="text-sm text-gray-500">({{ count($reviews) }})</span>
        </div>
    </div>

    {{-- Séparateur --}}
    <hr class="border-gray-300">

    {{-- Annonces --}}
    <div class="flex gap-3">
        <div class="flex flex-col flex-grow gap-3">
            <span class="flex items-center gap-2 text-2xl font-medium"><i class="fa-solid fa-cart-shopping"></i>Annonces déposées <p class="text-sm opacity-50">({{ count($cars) }})</p></span>
            <div class="grid gap-4 grid-cols-auto-fit-card">
                @foreach ($cars as $car)
                    @if ($car->vente_enchere == 0)
                        <livewire:selling-card :car="$car" :key="$car->id" />
                    @else
                        <livewire:auction-card :car="$car" :key="$car->id" />
                    @endif
                @endforeach
            </div>
            @if (count($cars) == 0)
                <div class="opacity-50">Aucune annonce.</div>
            @endif
        </div>
        <di class="flex flex-col w-1/4 gap-3">
            <span class="flex items-center gap-2 text-2xl font-medium"><i class="fa-solid fa-star-sharp-half-stroke"></i>Avis <p class="text-sm opacity-50">({{ count($reviews) }})</p></span>
            <div class="flex flex-col gap-2 rounded-lg">
                @foreach ($reviews as $review)
                    <x-review-card-profile :review="$review" />
                @endforeach
            </div>
            @if (count($reviews) == 0)
                <div class="opacity-50">Aucun avis.</div>
            @endif
        </div>
    </div>
</div>

@endsection