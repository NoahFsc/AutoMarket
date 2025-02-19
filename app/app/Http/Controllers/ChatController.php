<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.chat');
    }

    public function startConversation($userId)
    {
        $currentUserId = Auth::id();

        // Vérifie si ce n'est pas nous-même
        if ($currentUserId == $userId) {
            return redirect()->route('chat.index');
        }

        // Vérifier si la conversation existe déjà
        $conversation = Conversation::where(function ($query) use ($currentUserId, $userId) {
            $query->where('user_id_sender', $currentUserId)
                ->where('user_id_receiver', $userId);
        })->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('user_id_sender', $userId)
                ->where('user_id_receiver', $currentUserId);
        })->first();

        // Si la conversation n'existe pas, la créer
        if (! $conversation) {
            $conversation = Conversation::create([
                'user_id_sender' => $currentUserId,
                'user_id_receiver' => $userId,
            ]);
        }

        // Rediriger vers la route chat.index avec l'ID de la conversation
        return redirect()->route('chat.index', ['conversationId' => $conversation->id]);
    }
}
