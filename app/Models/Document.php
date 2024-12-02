<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'car_id',
        'document_type',
        'document_content',
    ];

    // Voiture à laquelle appartient le document
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
