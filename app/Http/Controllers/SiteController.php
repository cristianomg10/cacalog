<?php

namespace App\Http\Controllers;

use App\Models\PlanoEntrega;

class SiteController extends Controller
{
    public function index()
    {
        $planos = PlanoEntrega::all();
        return view('landing.index', compact('planos'));
    }
}
