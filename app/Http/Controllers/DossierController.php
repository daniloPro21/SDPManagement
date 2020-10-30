<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Repositories\DossierRepository;

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
        $dossiersTrie;
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
        $data = $request->validate(array(
            'num_sdp' => 'required',
            'num_dra' => 'required',
            'personne_id' => 'required',
            'type_id' => 'required',
            'note' => 'required',
            'date_entre' => 'required',
            'date_sortie' => 'required'
        ));

        $dossier = new Dossier();
        $dossier->num_sdp = $data['num_sdp'];
        $dossier->num_dra = $data['num_dra'];
        $dossier->date_entre = $data['date_entre'];
        $dossier->date_sortie =  $data['date_sortie'];
        $dossier->personne_id = $data['personne_id'];
        $dossier->type_id = $data['type_id'];
        $dossier->note = $data['note'];
        $dossier->traiter = false;
        $dossier->service_id = 1;

        $dossier->save();


        return back();
    }

    public function quotation($id,$dossier_id){
      $dossier = Dossier::findOrFail($dossier_id);
      $dossier->service_id=$id;
      $dossier->update();


      return redirect()->back()->withMessage("Affectation Terminée");

    }
}
