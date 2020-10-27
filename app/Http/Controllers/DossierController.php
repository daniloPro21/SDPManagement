<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dossier;
use App\Repositories\DossierRepository;

class DossierController extends Controller
{
  public  $dossierRepository;
  public function __construct(DossierRepository $dossierRepository)
  {
      $this->dossierRepository=$dossierRepository;
      $this->middleware('auth');
  }

  public function listeDossier($type){
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

    return view("Admin.listedossier",compact('dossiersTrie'));
  }

  public function dossiers(){

    return view('Admin.dossiers');
  }

  public function detail($id){
    $dossier=Dossier::findOrFail($id);
    return view('Admin.details',compact('dossier'));
  }

  public function find(){
    return view('Admin.search');
  }
}
