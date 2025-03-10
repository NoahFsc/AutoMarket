<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReferencesController extends Controller
{
    public function brands()
    {
        return view('admin.references.brands-list');
    }

    public function models()
    {
        return view('admin.references.models-list');
    }

    public function critair()
    {
        return view('admin.references.critair-list');
    }

    public function carburants()
    {
        return view('admin.references.carburants-list');
    }

    public function portieres()
    {
        return view('admin.references.portieres-list');
    }

    public function boites()
    {
        return view('admin.references.boites-list');
    }

    public function types()
    {
        return view('admin.references.types-list');
    }
}
