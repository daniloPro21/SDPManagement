<?php

namespace App\Repositories;


use App\Dossier;
use App\Service;


class ProduitRepository
{

    public function getDossiers() {
        return Dossier::where('is_delete', false)->get();
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
