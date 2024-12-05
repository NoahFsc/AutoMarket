<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\WebsiteReview;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sells = Car::where('vente_enchere', 0)->get();
        $auctions = Car::where('vente_enchere', 1)->get();
        $reviews = WebsiteReview::all();

        return view('home', compact('sells', 'auctions', 'reviews'));
    }
}
