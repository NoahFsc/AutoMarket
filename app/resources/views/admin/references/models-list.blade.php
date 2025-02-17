@extends('layout-admin')

@section('titre', 'Ref. Modèles')

@section('contenu')

<div class="flex flex-grow gap-16 bg-white">
    <livewire:admin-sidebar />
    <livewire:model.models-catalog />
</div>

@endsection