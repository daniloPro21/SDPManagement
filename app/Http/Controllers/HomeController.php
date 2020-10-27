<?php

namespace App\Http\Controllers;

use App\Dossier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function admin()
    {
        return view('Admin.home');
    }

    public function secretaire()
    {
        $dossiers = Dossier::all();
        return view('Secretaire.home', compact('dossiers'));
    }

    public function service()
    {
        return view('Services.home');
    }
}