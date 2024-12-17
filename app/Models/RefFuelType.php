<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefFuelType extends Model
{
    protected $table = 'referentiels_fuel_type';

    protected $fillable = [
        'nom'
    ];

    public $timestamps = false;
}
