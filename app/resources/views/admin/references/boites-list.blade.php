@extends('layout-admin')

@section('titre', 'Ref. Boîtes')

@section('contenu')

<div class="flex flex-grow gap-16 bg-reverse">
    <livewire:admin-sidebar />
    <livewire:gearbox.gearboxes-catalog />
</div>

@endsection