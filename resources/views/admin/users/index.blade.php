@extends('layout')

@section('titre', 'Utilisateurs')

@section('contenu')

<div class="flex flex-grow gap-16">
    <livewire:dashboard-sidebar />
    <livewire:users-catalog />
</div>

@endsection