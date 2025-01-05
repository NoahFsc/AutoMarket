<div class="relative flex flex-col h-screen">
    @if($messages && $conversationId)

    {{-- Barre supérieure --}}
    <div class="flex items-center justify-between pr-8 border-b-2 border-gray-200">
        {{-- Informations profil --}}
        <div class="flex gap-2 p-4">
            <img src="{{ $cible->profile_picture ? asset('storage/' . $cible->profile_picture) : asset('assets/default_pfp.png') }}" class="w-12 h-12 rounded-full" alt="avatar">
            <div class="flex justify-between w-full">
                <div class="flex flex-col items-start">
                    <span class="font-medium">{{ $cible->first_name . ' ' . $cible->last_name }}</span>
                    <span class="text-sm opacity-50">{{ '@' . strtolower($cible->first_name . $cible->last_name) }}</span>
                </div>
            </div>
        </div>

        {{-- Boutons d'action --}}
        <div class="flex items-center gap-2">
            <livewire:report-user :userId="$cible->id" />
            <a href="{{ route('user.index', $cible->id) }}" class="px-8 py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary-500 hover:bg-primary-400">Voir le profil</a>
        </div>
    </div>

    {{-- Conversation --}}
    <div wire:poll.1000ms="updateMessages" class="flex flex-col-reverse flex-grow px-4 py-2 pb-16 overflow-y-auto" id="chat-box">
        {{-- Messages --}}
        @foreach($messages as $message)
            @if($message->user_id === Auth::id())
                {{-- Message de l'utilisateur connecté --}}
                <div class="flex justify-end">
                    <div class="flex flex-col items-end mb-4 max-w-[50%]">
                        <div class="flex justify-between w-full mb-1 min-w-64">
                            <span>Vous</span>
                            <span class="text-sm opacity-50">{{ $message->formatted_date }}</span>
                        </div>
                        <div class="p-4 text-white rounded-lg rounded-tr-none bg-primary-500 min-w-64">
                            {{ $message->content }}
                        </div>
                    </div>
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}" class="ml-2 rounded-full size-12" alt="avatar">
                </div>
            @else
                {{-- Message de la cible --}}
                <div class="flex justify-start">
                    <img src="{{ $cible->profile_picture ? asset('storage/' . $cible->profile_picture) : asset('assets/default_pfp.png') }}" class="w-8 h-8 mr-2 rounded-full" alt="avatar">
                    <div class="flex flex-col items-start mb-4 max-w-[50%]">
                        <div class="flex justify-between w-full mb-1 min-w-64">
                            <span>{{ $cible->first_name . ' ' . $cible->last_name }}</span>
                            <span class="text-sm opacity-50">{{ $message->formatted_date }}</span>
                        </div>
                        <div class="p-4 bg-gray-300 rounded-lg rounded-tl-none min-w-64">
                            {{ $message->content }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Zone d'envoi --}}
    <div class="absolute bottom-0 flex w-full m-4">
        <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage" class="w-11/12 p-2 border-gray-300 rounded-l-md focus:outline-none" placeholder="Envoyer un message">
        <button wire:click="sendMessage" class="px-4 py-2 text-white bg-primary-500 rounded-r-md hover:bg-primary-400"><i class="fa-regular fa-paper-plane-top"></i></button>
    </div>

    @else
    <span class="flex justify-center w-full my-24 opacity-50">Sélectionnez une conversation</span>
    @endif
</div>

<script>
    document.addEventListener('livewire:load', function () {
        var chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;

        Livewire.hook('message.processed', (message, component) => {
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    });
</script>