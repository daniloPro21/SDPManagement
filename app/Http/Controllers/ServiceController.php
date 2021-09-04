<?php

namespace App\Http\Controllers;

use App\Cotation;
use App\Dossier;
use App\Service;
use App\ServiceGeneral;
use App\Trace;
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
       $newDossiers = Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
           ->where("cotations.service_id", "=", auth()->user()->sous_service_id)
           ->where('dossiers.statut', 'encour')
           ->select('dossiers.*')
           ->distinct()
           ->get();

       // $service_name = ServiceGeneral::findOrfail(auth()->user()->service_id);


        return view('Services.dossiercoter', compact('newDossiers') );
    }

    public function listTraiter()
    {
        $dossiersTraiters = Dossier::with('type','service','services', 'track')
            ->where('sous_service_id', '=', auth()->user()->sous_service_id)
            ->where('statut', '=', 'traiter')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);

        $service_name = ServiceGeneral::findOrfail(auth()->user()->service_id);


        return view('Services.dossiertraiter', compact('dossiersTraiters','service_name') );
    }


    public function ShowGroup($id)
    {
        $dossiersFiltrer = Dossier::where('is_delete', false)->where('sous_service_id', $id)->get();
        $typeDossier = Service::findOrFail($id);
        return view("Admin.dossiersSousService", compact("dossiersFiltrer", "typeDossier"));
    }


}
