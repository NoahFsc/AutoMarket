<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'proposed_price',
        'accepted_declined',
        'status',
        'user_id',
        'car_id',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    // Utilisateur ayant proposé l'offre
    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Voiture concernée par l'offre
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
