<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'birth_date',
        'identity_card',
        'adresse',
        'telephone',
        'profile_picture',
        'description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Voitures mises en vente par l'utilisateur
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    // Prix sur une enchère proposé par l'utilisateur
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    // Offres faites par l'utilisateur sur une voiture (message envoyé au vendeur)
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    // Avis du site laissés par l'utilisateur
    public function websiteReviews()
    {
        return $this->hasMany(WebsiteReview::class);
    }

    // Avis reçus sur l'utilisateur par d'autres utilisateurs
    public function userReviewsReceived()
    {
        return $this->hasMany(UserReview::class, 'user_id_receiver');
    }

    // Avis laissés par l'utilisateur sur d'autres utilisateurs
    public function userReviewsWritten()
    {
        return $this->hasMany(UserReview::class, 'user_id_writer');
    }
}
