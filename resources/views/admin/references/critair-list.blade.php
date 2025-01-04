@extends('layout-admin')

@section('titre', 'Ref. Critair')

@section('contenu')

<div class="flex flex-grow gap-16 bg-white">
    <livewire:admin-sidebar />
    <livewire:critair.critair-catalog />
</div>

@endsection