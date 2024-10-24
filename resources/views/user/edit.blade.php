@extends('layout')

@section('titre', 'Edition Profil')

@section('contenu')

<div class="flex flex-col gap-3 mx-8 md:w-1/3 md:mx-auto">

    <a href="{{ route('user.index') }}" class="text-sm text-gray-400 hover:text-gray-500">
        <i class="mr-1 fa-solid fa-arrow-left fa-sm"></i> Retour
    </a>

    {{-- Entête --}}
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col items-center gap-4">
            <div class="relative">
                <img src="{{ Auth::user()->photo_de_profil ? asset('storage/' . Auth::user()->photo_de_profil) : asset('assets/default_pfp.png') }}" alt="Avatar" class="rounded-full size-20">
                <button type="button" class="absolute flex items-center justify-center size-8" style="bottom: -5px; right: -5px;">
                    <span class="fa-stack fa-1x">
                        <i class="fa fa-circle fa-stack-2x text-primary-500"></i>
                        <i class="fa-regular fa-pen fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
                <input type="file" name="photo_de_profil" class="hidden" id="photo_de_profil">
            </div>
            <div class="flex flex-col items-center">                
                <span class="text-2xl font-bold md:text-4xl">{{Auth::user()->prenom . ' ' . Auth::user()->nom }}</span>
                <span class="text-base text-gray-500">{{ '@' . strtolower(Auth::user()->prenom . Auth::user()->nom) }} </span>
            </div>
        </div>
    </form>

</div>

<script>
    document.querySelector('button[type="button"]').addEventListener('click', function() {
        document.getElementById('photo_de_profil').click();
    });
</script>

@endsection