<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefCritAir extends Model
{
    protected $table = 'referentiels_crit_air';

    protected $fillable = [
        'image',
        'nom'
    ];

    public $timestamps = false;
}
