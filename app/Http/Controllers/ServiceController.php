<?php

namespace App\Http\Controllers;

use App\Cotation;
use App\Dossier;
use App\Service;
use App\ServiceGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  index(){
        $services=Service::with("servicegenerals")->get();
        $genral_service=ServiceGeneral::all();
        //dd($services);
        return view("Admin.service",compact('services', 'genral_service'));
    }

    public function  store(Request $request){
        Service::create($request->all());
        Toastr()->success("Enregistrement Effectué");
        return redirect()->back()->withMessage("Enregistrement Effectué");
    }
     public function listcoter()
    {
        $newDossiers = DB::table('cotations')
        ->join('dossiers', 'cotations.id_dossier', '=', 'dossiers.id')
        ->join('services', 'services.id', '=', 'cotations.id_service')
        ->where('cotations.id_service', '=', auth()->user()->sous_service_id)
        ->select('dossiers.*', 'services.*', 'cotations.*')
        ->paginate(10);

       // $service_name = ServiceGeneral::findOrfail(auth()->user()->service_id);


        return view('Services.dossiercoter', compact('newDossiers') );
    }

    public function listTraiter()
    {
        $dossiersTraiters = DB::table('cotations')
        ->join('dossiers', 'cotations.id_dossier', '=', 'dossiers.id')
        ->join('services', 'services.id', '=', 'cotations.id_service')
        ->where('cotations.id_service', '=', auth()->user()->sous_service_id)
        ->select('dossiers.*', 'services.*', 'cotations.*')
        ->paginate(10);
        $service_name = ServiceGeneral::findOrfail(auth()->user()->service_id);


        return view('Services.dossiertraiter', compact('dossiersTraiters','service_name') );
    }


}
