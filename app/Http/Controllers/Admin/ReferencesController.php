<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ReferencesController extends Controller
{
    public function index()
    {
        return view('admin.references.index');
    }
}
