<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function  index(){
        $services=Service::all();
        return view("Admin.service",compact('services'));
    }

    public function  store(Request $request){
        Service::create($request->all());
        Toastr()->success("Enregistrement Effectué");
        return redirect()->back()->withMessage("Enregistrement Effectué");
    }
     public function listcoter()
    {
        $dossiers = Dossier::all()->where('service_id', '=', auth()->user()->service_id);

        return view('Services.dossiercoter', compact('dossiers') );
    }


}
