<div class="relative flex flex-col h-screen">
    @if($messages && $conversationId)

    {{-- Barre supérieure --}}
    <div class="flex items-center justify-between pr-8 border-b-2 border-input">
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
            <a href="{{ route('user.index', $cible->id) }}" class="px-8 py-2 text-sm text-center text-white rounded-lg md:duration-300 md:transition-all bg-primary hover:bg-opacity-80">{{ __('ViewProfile') }}</a>
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
                            <span>{{ __('You') }}</span>
                            <span class="text-sm opacity-50">{{ $message->formatted_date }}</span>
                        </div>
                        <div class="text-white rounded-lg rounded-tr-none {{ $message->offer ? '' : 'bg-primary p-4'}} min-w-64">
                            @if ($message->offer)
                                <livewire:chat.offer-card :offer="$message->offer" :key="$message->id" />
                            @else
                                {{ $message->content }}
                            @endif
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
                        <div class="{{ $message->offer ? '' : 'bg-input p-4'}} rounded-lg rounded-tl-none min-w-64">
                            @if ($message->offer)
                                <livewire:chat.offer-card :offer="$message->offer" :key="$message->id" />
                            @else
                                {{ $message->content }}
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Zone d'envoi --}}
    <div class="absolute bottom-0 flex w-full m-4">
        <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage" class="w-11/12 p-2 border-input-border bg-input rounded-l-md focus:outline-none" placeholder="{{ __('SendMessagePlaceholder') }}">
        <button wire:click="sendMessage" class="px-4 py-2 text-white bg-primary rounded-r-md hover:bg-opacity-80"><i class="fa-regular fa-paper-plane-top"></i></button>
    </div>

    @else
    <span class="flex justify-center w-full my-24 text-default/50">{{ __('SelectConversation') }}</span>
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