<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = [
        'equipment_name',
    ];

    public $timestamps = false;

    // Toutes les voitures qui ont cet équipement
    public function cars()
    {
        return $this->belongsToMany(CarsEquipment::class, 'equipment_id');
    }
}
