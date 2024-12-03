<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteReview extends Model
{
    protected $fillable = [
        'nb_of_star',
        'comment',
        'user_id',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    // Utilisateur ayant laissé l'avis
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
