@extends('layout-admin')

@section('titre', 'Signalements')

@section('contenu')

<div class="flex flex-grow gap-16 bg-white">
    <livewire:admin-sidebar />
    <livewire:reports-catalog />
</div>

@if (session('status'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="fixed bottom-0 right-0 p-4 mb-4 mr-4 text-white bg-gray-800 rounded-lg shadow-lg bg-opacity-80">
        <div class="flex items-center font-medium">
            <i class="mr-2 text-xl fa-regular fa-circle-check text-validation-500"></i>
            {{ session('status') }}
        </div>
        @if (session('concerned_user_id'))
            <a href="{{ route('user.index', ['id' => session('concerned_user_id')]) }}" class="block mt-2 text-sm text-white opacity-50 hover:opacity-75">Voir le compte</a>
        @endif
    </div>
@endif
    
@endsection