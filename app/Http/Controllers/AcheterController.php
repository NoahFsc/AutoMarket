<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcheterController extends Controller
{
    public function index()
    {
        $cards = null;
        //$cards = collect($cards)->paginate(12);

        return view('acheter.index', compact('cards'));
    }
}
