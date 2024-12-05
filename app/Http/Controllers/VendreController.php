<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\WebsiteReview;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendreController extends Controller
{
    public function index()
    {
        $sells = Car::whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->where('vente_enchere', 0)->get();

        $auctions = Car::whereHas('user', function ($query) {
            $query->where('id', Auth::id());
        })->where('vente_enchere', 1)->get();

        return view('vendre.index', compact('sells', 'auctions'));
    }
}
