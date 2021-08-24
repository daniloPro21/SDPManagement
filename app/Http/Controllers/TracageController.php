<?php

namespace App\Http\Controllers;

use App\Tracage;
use Illuminate\Http\Request;

class TracageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
       $tracage = new Tracage();
       $tracage->serviceA = $request->serviceA;
       $tracage->serviceB = $request->serviceB;
       $tracage->motif = $request->motif;
       $tracage->save();
        Toastr()->success("Enregistrement Effectué");
       return redirect()->back();
    }
}
