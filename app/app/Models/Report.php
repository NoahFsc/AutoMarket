<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reason',
        'status',
        'user_id_receiver',
        'user_id_writer',
    ];

    // Utilisateur ayant reçu le signalement
    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id_receiver');
    }

    // Utilisateur ayant écrit le signalement
    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id_writer');
    }
}
