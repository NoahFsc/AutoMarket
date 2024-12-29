<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OffersController extends Controller
{
    public function index()
    {
        return view('admin.offers-list');
    }
}
