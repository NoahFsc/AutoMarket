<div class="flex flex-col h-screen">
    {{-- Logo --}}
    <a href="{{ route('home') }}">
        <div class="flex items-center">
            <img :src="darkMode ? '{{ asset('assets/logo_automarket_light.png') }}' : '{{ asset('assets/logo_automarket.webp') }}'" alt="Logo" class="h-16 mb-2">
            <span class="text-xl font-medium">AutoMarket</span>
        </div>
    </a>
    
    {{-- Contenu de la sidebar --}}
    <div class="flex flex-col justify-between flex-grow">
        <div class="flex flex-col flex-grow bg-background">

            {{-- Titre et barre de recherche --}}
            <span class="mt-4 ml-4 text-xl font-medium">Messages</span>
            <input type="text" wire:model.live='search' placeholder="Rechercher" class="h-10 m-4 mt-2 border-input-border bg-input rounded-t-md md:rounded-md focus:border-primary focus:ring-primary">

            {{-- Liste des conversations --}}
            @foreach($conversations as $conversation)
                @php
                    $cible = $conversation->otherUser;
                @endphp

                {{-- Une conversation --}}
                <a wire:click="selectConversation({{ $conversation->id }})">
                    <div class="flex flex-col p-2 cursor-pointer border-b-2 border-input-border {{ $activeConversationId === $conversation->id ? 'bg-input' : 'hover:bg-input' }}">
                        <div class="flex gap-2">
                            <img src="{{ $cible->profile_picture ? asset('storage/' . $cible->profile_picture) : asset('assets/default_pfp.png') }}" class="w-12 h-12 rounded-full" alt="avatar">
                            <div class="flex justify-between w-full">
                                <div class="flex flex-col items-start">
                                    <span class="font-medium">{{ $cible->first_name . ' ' . $cible->last_name }}</span>
                                    <span class="text-sm text-default/50">{{ '@' . strtolower($cible->first_name . $cible->last_name) }}</span>
                                </div>
                                <div>
                                    <span class="text-sm">{{ optional($conversation->chats->last())->send_at ? \Carbon\Carbon::parse(optional($conversation->chats->last())->send_at)->diffForHumans(null, true) : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <span class="text-sm text-default/50">{{ optional($conversation->chats->last())->content }}</span>
                    </div>
                </a>
            @endforeach
        
        </div>
        
        {{-- Retour --}}
        <a href="{{ route('home') }}" class="flex items-center justify-center h-12 mb-8 text-default/50 hover:text-default/80">
            <i class="mr-2 fa-regular fa-arrow-left"></i> Retour à l'accueil
        </a>
    </div>
</div>