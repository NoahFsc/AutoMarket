<?php

namespace App\Http\Controllers;

class CatalogController extends Controller
{
    public function acheter()
    {
        return view('catalog.index', ['type' => 0]);
    }

    public function encherir()
    {
        return view('catalog.index', ['type' => 1]);
    }
}
