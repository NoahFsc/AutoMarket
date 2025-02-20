@extends('layout-admin')

@section('titre', 'Ref. Carburants')

@section('contenu')

<div class="flex flex-grow gap-16 bg-reverse">
    <livewire:admin-sidebar />
    <livewire:fuel-type.fuel-types-catalog />
</div>

@endsection