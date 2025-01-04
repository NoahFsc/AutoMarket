@extends('layout-admin')

@section('titre', 'Ref. Portières')

@section('contenu')

<div class="flex flex-grow gap-16 bg-white">
    <livewire:admin-sidebar />
    <livewire:nb-door.nb-doors-catalog />
</div>

@endsection