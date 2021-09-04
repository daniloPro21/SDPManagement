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
       $tracage->serviceB = auth()->user()->general->name;
       $tracage->motif = $request->motif;
       $tracage->dossier_id = $request->dossier_id;
       $tracage->save();
        Toastr()->success("Enregistrement Effectué");
       return redirect()->back();
    }
}
