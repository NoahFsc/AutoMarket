<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::all(); // Modèle pour les voitures
        $auctions = Auction::active()->get(); // Modèle pour les enchères actives
        $testimonials = Testimonial::all();

        return view('home', compact('cars', 'auctions', 'testimonials'));
    }
}
