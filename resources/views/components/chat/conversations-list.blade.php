<div class="flex flex-col justify-between h-screen">
    <div class="flex flex-col border-b-2 divide-y-2 bg-background">
        <span class="mt-4 ml-4 text-xl font-medium">Messages</span>
        <input type="text" wire:model.live='search' placeholder="Rechercher" class="h-10 m-4 mt-2 border-gray-300 rounded-t-md md:rounded-md focus:border-primary-500 focus:ring-primary-500">
        @foreach($conversations as $conversation)
            @php
                $cible = $conversation->otherUser;
            @endphp
            <a wire:click="selectConversation({{ $conversation->id }})">
                <div class="flex flex-col p-2 cursor-pointer {{ $activeConversationId === $conversation->id ? 'bg-gray-300' : 'hover:bg-gray-200' }}">
                    <div class="flex gap-2">
                        <img src="{{ $cible->profile_picture ? asset('storage/' . $cible->profile_picture) : asset('assets/default_pfp.png') }}" class="w-12 h-12 rounded-full" alt="avatar">
                        <div class="flex justify-between w-full">
                            <div class="flex flex-col items-start">
                                <span class="font-medium">{{ $cible->first_name . ' ' . $cible->last_name }}</span>
                                <span class="text-sm opacity-50">{{ '@' . strtolower($cible->first_name . $cible->last_name) }}</span>
                            </div>
                            <div>
                                <span class="text-sm">{{ optional($conversation->chats->last())->send_at ? \Carbon\Carbon::parse(optional($conversation->chats->last())->send_at)->diffForHumans(null, true) : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <span class="text-sm opacity-50">{{ optional($conversation->chats->last())->content }}</span>
                </div>
            </a>
        @endforeach
    
    </div>
    {{-- Bouton "retour à l'accueil" tout en bas de la liste --}}
    <a href="{{ route('home') }}" class="flex items-center justify-center h-12 mb-8 text-gray-500 hover:text-gray-700">
        <i class="mr-2 fa-regular fa-arrow-left"></i> Retour à l'accueil
    </a>
</div>