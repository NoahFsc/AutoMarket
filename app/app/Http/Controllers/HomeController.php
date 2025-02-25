<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\WebsiteReview;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $sells = Car::where('vente_enchere', 0)->get();
        $auctions = Car::where('vente_enchere', 1)->get();
        $reviews = WebsiteReview::all();

        return view('home', compact('sells', 'auctions', 'reviews'));
    }

    public function dashboard()
    {

        $chiffreAffaire = Car::whereIn('id', Order::select('car_id'))->sum('selling_price');

        $moyenneSatisfaction = WebsiteReview::avg('nb_of_star');
        
        return view('admin.dashboard', compact('chiffreAffaire', 'moyenneSatisfaction'));
    }
}
