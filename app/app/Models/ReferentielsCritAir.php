<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferentielsCritAir extends Model
{
    protected $table = 'referentiels_crit_air';

    protected $fillable = [
        'image',
        'nom',
    ];

    public $timestamps = false;
}
