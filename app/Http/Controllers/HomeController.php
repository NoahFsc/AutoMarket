<?php

namespace App\Http\Controllers;

use App\Models\Car;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::with('imageDocument', 'carModel')->get();
        return view('home', compact('cars'));
    }
}
