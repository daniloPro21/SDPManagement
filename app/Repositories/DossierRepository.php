<?php

namespace App\Repositories;


use App\Dossier;
use App\Service;


class DossierRepository
{

    public function getDossiers() {
        return Dossier::where('is_delete', false)->get();
    }

    public function getNewDossiers(){
      return Dossier::where('service_id',null)->get();
    }

    public function getAssignDossiers(){
      return Dossier::where('service_id','!=',null)->where('traiter',false)->get();
    }

    public function getDossiersTraiter(){
      return Dossier::where('traiter',true)->get();
    }


    public function save(Dossier $dossier){
      $dossier->is_delete=false;
      return $dossier->save();
    }


    public function coter(Dossier $dossier,Service $service){
      $dossier->service_id=$service->id;
      return $dossier->update();
    }

}
