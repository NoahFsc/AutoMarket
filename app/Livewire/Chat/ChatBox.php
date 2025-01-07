<?php

namespace App\Livewire\Chat;

use App\Models\Chat;
use App\Models\Conversation;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatBox extends Component
{
    public $conversationId;
    public $messages;
    public $newMessage;
    public $cible;

    #[On('conversationSelected')]
    public function loadConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $conversation = Conversation::find($conversationId);

        $this->cible = $conversation->user_id_sender === Auth::id() ? $conversation->receiver : $conversation->sender;
        $this->messages = Chat::where('conversation_id', $conversationId)
            ->orderBy('send_at', 'desc')->get()->map(function ($message) {
                $message->formatted_date = $this->formatDate($message->send_at);
                return $message;
            });
    }

    public function updateMessages()
    {
        $this->messages = Chat::where('conversation_id', $this->conversationId)
            ->orderBy('send_at', 'desc')->get()->map(function ($message) {
                $message->formatted_date = $this->formatDate($message->send_at);
                return $message;
            });
    }

    public function sendMessage()
    {
        Chat::create([
            'content' => $this->newMessage,
            'conversation_id' => $this->conversationId,
            'user_id' => Auth::id(),
        ]);

        $this->newMessage = '';
        $this->loadConversation($this->conversationId);
    }

    private function formatDate($date)
    {
        $carbonDate = Carbon::parse($date);
        if ($carbonDate->isToday()) {
            return 'Aujourd\'hui à ' . $carbonDate->format('H:i');
        } elseif ($carbonDate->isYesterday()) {
            return 'Hier à ' . $carbonDate->format('H:i');
        } else {
            return $carbonDate->format('d/m/Y H:i');
        }
    }

    public function render()
    {
        return view('components.chat.chat-box');
    }
}
