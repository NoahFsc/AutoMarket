<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $fillable = [
        'nb_of_star',
        'comment',
        'user_id_receiver',
        'user_id_writer',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    // Utilisateur ayant reçu l'avis
    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id_receiver');
    }

    // Utilisateur ayant écrit l'avis
    public function writer()
    {
        return $this->belongsTo(User::class, 'user_id_writer');
    }
}
