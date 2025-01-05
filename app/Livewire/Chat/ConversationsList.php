<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConversationsList extends Component
{
    public $conversations;
    public $activeConversationId;
    public string $search = '';

    public function mount()
    {
        $this->loadConversations();
    }

    public function selectConversation($conversationId)
    {
        $this->activeConversationId = $conversationId;
        $this->dispatch('conversationSelected', $conversationId);
    }

    public function loadConversations()
    {
        $userId = Auth::id();

        $this->conversations = Conversation::where(function ($query) use ($userId) {
            $query->where('user_id_sender', $userId)
                ->orWhere('user_id_receiver', $userId);
        })
            ->where(function ($query) {
                $query->whereHas('sender', function ($query) {
                    $query->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%');
                })
                    ->orWhereHas('receiver', function ($query) {
                        $query->where('first_name', 'like', '%' . $this->search . '%')
                            ->orWhere('last_name', 'like', '%' . $this->search . '%');
                    });
            })
            ->get();
    }

    public function updatedSearch()
    {
        $this->loadConversations();
    }

    public function render()
    {
        return view('components.chat.conversations-list', [
            'conversations' => $this->conversations,
        ]);
    }
}
