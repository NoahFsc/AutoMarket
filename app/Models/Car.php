<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_car',
        'car_year',
        'mileage',
        'consommation',
        'nb_door',
        'provenance',
        'puissance_fiscale',
        'puissance_din',
        'boite_vitesse',
        'carburant',
        'vente_enchere',
        'minimum_price',
        'selling_price',
        'deadline',
        'crit_air',
        'co2_emission',
        'status',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    // Utilisateur ayant mis en vente la voiture
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tous les documents de la voiture (carte grise, images...)
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Récupérer l'image de couverture de la voiture (la première image)
    public function imageDocument()
    {
        return $this->hasOne(Document::class)->where('document_type', 'image');
    }

    // Récupérer le modèle de la voiture
    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
}
