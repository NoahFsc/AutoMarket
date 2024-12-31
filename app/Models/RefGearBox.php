<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefGearbox extends Model
{
    protected $table = 'referentiels_gearbox_type';

    protected $fillable = [
        'nom'
    ];

    public $timestamps = false;
}
