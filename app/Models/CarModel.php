<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = [
        'model_name',
        'brand_id',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    // La marque de ce modèle
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Tous les véhicules mis en vente de ce modèle
    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id');
    }
}
