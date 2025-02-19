<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    protected $fillable = [
        'user_id_sender',
        'user_id_receiver',
    ];

    public $timestamps = false;

    public $CREATED_AT = 'created_at';

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id_sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id_receiver');
    }

    public function getOtherUserAttribute()
    {
        return $this->user_id_sender === Auth::id() ? $this->receiver : $this->sender;
    }
}
