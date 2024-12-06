@extends('layout')

@section('titre')
    {{ $type == 0 ? 'Acheter' : 'Enchérir' }}
@endsection

@section('contenu')
<div class="container mx-auto mt-2">
    <livewire:car-catalog :type="$type" />
</div>
@endsection