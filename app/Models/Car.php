<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_car',
        'car_year',
        'mileage',
        'consommation',
        'nb_door',
        'provenance',
        'puissance_fiscale',
        'puissance_din',
        'boite_vitesse',
        'carburant',
        'vente_enchere',
        'minimum_price',
        'selling_price',
        'deadline',
        'crit_air',
        'co2_emission',
        'status',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;

    const CREATED_AT = 'created_at';
}
