<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefNbDoor extends Model
{
    protected $table = 'referentiels_nb_doors';

    protected $fillable = [
        'nb_doors'
    ];

    public $timestamps = false;
}
