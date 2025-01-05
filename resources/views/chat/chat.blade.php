@extends('layout-empty')

@section('titre', 'Conversation')

@section('contenu')
<div class="flex flex-grow overflow-x-hidden border-2 divide-x-2">
    <div class="w-1/5">
        <livewire:chat.conversations-list />
    </div>
    <div class="w-4/5">
        <livewire:chat.chat-box />
    </div>
</div>
@endsection