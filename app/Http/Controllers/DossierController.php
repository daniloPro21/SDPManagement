<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Repositories\DossierRepository;
use Yoeunes\Toastr\Toastr;

class DossierController extends Controller
{
    public $dossierRepository;
    public function __construct(DossierRepository $dossierRepository)
    {
        $this->dossierRepository=$dossierRepository;
        $this->middleware('auth');
    }

    public function listeDossier($type)
    {
        //$dossiersTrie;
        switch ($type) {
      case 'non-coter':
        $dossiersTrie= $this->dossierRepository->getNewDossiers();
        break;
      case 'coter':
          $dossiersTrie= $this->dossierRepository->getAssignDossiers();
        break;
      case 'traiter':
            $dossiersTrie= $this->dossierRepository->getDossiersTraiter();
        break;

      default:
          $dossiersTrie=$this->dossierRepository->getDossiers();
        break;
    }

        return view("Admin.listedossier", compact('dossiersTrie'));
    }

    public function dossiers()
    {
        return view('Admin.dossiers');
    }

    public function detail($id)
    {
        $dossier=Dossier::findOrFail($id);
        return view('Admin.details', compact('dossier'));
    }

    public function find()
    {
        return view('Admin.search');
    }

    public function store(Request $request)
    {
       //dd($request->all());
        $data = $request->validate(array(
            'num_sdp' => 'required',
            'num_dra' => 'required',
            'type_id' => 'required',
            'note' => 'required',
            'date_entre' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'grade' => 'required',
            'matricule'=> 'required'
        ));

        $dossier = new Dossier();
        $dossier->num_sdp = $data['num_sdp'];
        $dossier->num_dra = $data['num_dra'];
        $dossier->date_entre = $data['date_entre'];
        $dossier->nom = $data['nom'];
        $dossier->prenom = $data['prenom'];
        $dossier->grade = $data['grade'];
        $dossier->matricule = $data['matricule'];
        $dossier->type_id = $data['type_id'];
        $dossier->note = $data['note'];
        //dd($dossier);

        $dossier->save();


        Toastr()->success("Enregistrement Effectué");


        return back()->with("Error");

    }

    public function quotation($id,$dossier_id){
      $dossier = Dossier::findOrFail($dossier_id);
      $dossier->service_id=$id;
      $dossier->update();

        Toastr()->success("Affectation Enregistré");

      return redirect()->back();

    }

    public function traiter($id){
        $dossier = Dossier::findOrFail($id);
        $dossier->traiter=true;
        $dossier->update();

        Toastr()->success("Mise a Jour Effectué");

        return redirect()->back();

    }

    public function findresult(Request $request){
        $dossiersTrie= Dossier::where('num_dra',$request->recherche)->paginate(20);
        return view("Admin.listedossier", compact('dossiersTrie'));
    }
}
