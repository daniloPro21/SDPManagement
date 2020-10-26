<?php

namespace App\Http\Controllers;

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
        return view('Secretaire.home');
    }

    public function service()
    {
        return view('Secretaire.home');
    }
}