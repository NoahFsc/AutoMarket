@extends('layout')

@section('titre', 'Dashboard')

@section('contenu')

<div class="flex gap-16">
    
    <livewire:dashboard-sidebar />

    <div>
        Contenu dashboard
    </div>
</div>

@endsection