<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'proposed_price',
        'status',
        'user_id',
        'car_id',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    // Utilisateur ayant déposé un prix pour l'enchère
    public function buyer()
    {
        return $this->belongsTo(User::class);
    }

    // Voiture concernée par l'enchère
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
