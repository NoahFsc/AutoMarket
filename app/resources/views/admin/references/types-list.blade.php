@extends('layout-admin')

@section('titre', 'Ref. Types')

@section('contenu')

<div class="flex flex-grow gap-16 bg-reverse">
    <livewire:admin-sidebar />
    <livewire:type.types-catalog />
</div>

@endsection
