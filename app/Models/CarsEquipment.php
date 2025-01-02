<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarsEquipment extends Model
{
    protected $primaryKey = 'car_equipment_id';
    protected $table = 'cars_equipments';

    protected $fillable = [
        'car_id',
        'equipment_id',
    ];

    public $timestamps = false;

    // Voiture à laquelle appartient l'équipement
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Equipement correspondant
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
