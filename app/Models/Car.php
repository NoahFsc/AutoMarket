<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_car_id',
        'car_year',
        'mileage',
        'consommation',
        'nb_door_id',
        'provenance',
        'puissance_fiscale',
        'puissance_din',
        'boite_vitesse_id',
        'carburant_id',
        'vente_enchere',
        'minimum_price',
        'selling_price',
        'deadline',
        'crit_air_id',
        'co2_emission',
        'model_id',
        'status_ct',
        'commentaire_vendeur',
        'user_id',
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

    // Récupérer le crit'air de la voiture
    public function critAir()
    {
        return $this->belongsTo(ReferentielsCritAir::class, 'crit_air_id');
    }

    // Récupérer le nombre de portes de la voiture
    public function nbDoor()
    {
        return $this->belongsTo(ReferentielsNbDoor::class, 'nb_door_id');
    }

    // Récupérer le type de carburant de la voiture
    public function fuelType()
    {
        return $this->belongsTo(ReferentielsFuelType::class, 'carburant_id');
    }

    // Récupérer la boîte de vitesse de la voiture
    public function gearBox()
    {
        return $this->belongsTo(ReferentielsGearBox::class, 'boite_vitesse_id');
    }

    // Récupérer le type de voiture
    public function typeOfCar()
    {
        return $this->belongsTo(ReferentielsVehiculeType::class, 'type_of_car_id');
    }
}
