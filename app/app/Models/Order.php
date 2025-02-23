<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'delivery_status',
        'user_id',
        'car_id',
        'delivery_date',
        'delivery_type',
    ];

    public $timestamps = false;

    protected $casts = [
        'delivery_date' => 'datetime',
    ];

    // Utilisateur ayant proposé la commande
    public function buyer()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Voiture concernée par la commande
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
