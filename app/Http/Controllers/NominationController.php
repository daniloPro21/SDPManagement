<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NominationController extends Controller
{
    public function index()
    {
        return view('Nominations.nomination');
    }

    public function cds()
    {
        return  view('Nominations.pdfetcvi');
    }

    public function eco()
    {
        return  view('Nominations.sgeteco');
    }
}
