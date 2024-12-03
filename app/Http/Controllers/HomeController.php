<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\WebsiteReview;
use App\Models\Brand;
use App\Models\CarModel;

class HomeController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $review = WebsiteReview::all();
        $carModels = CarModel::all();
        $brands = Brand::with('models')->get();

        return view('home', compact('cars', 'review', 'carModels', 'brands'));
    }
}
