<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefVehiculeType extends Model
{
    protected $table = 'referentiels_vehicule_type';

    protected $fillable = [
        'segment',
        'nom'
    ];

    public $timestamps = false;
}
