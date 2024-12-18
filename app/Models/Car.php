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
        'postal_code',
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
        'commentaire_vendeur',
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

    //Récupérer les équipements de la voiture
    public function equipments()
    {
        return $this->hasMany(CarsEquipment::class, 'car_id');
    }

    // Récupérer la dernière enchère de la voiture (une seule uniquement)
    public function lastBid()
    {
        return $this->hasMany(Bid::class)->latest();
    }
}
