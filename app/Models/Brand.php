<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'brand_name',
    ];

    public $timestamps = false;

    // Tous les modèles de la marque
    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
}
