<?php

namespace App\Repositories;

use App\Dossier;
use App\Service;

class DossierRepository
{
    public function getDossiers()
    {
        return Dossier::where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getNewDossiers()
    {
        return Dossier::where('service_id', null)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getAssignDossiers()
    {
        return Dossier::where('service_id', '!=', null)->where('is_delete', false)->orderByDesc('id')->where('traiter', false)->paginate(21);
    }

    public function getDossiersTraiter()
    {
        return Dossier::where('traiter', true)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getDossiersByServiceId()
    {
        return Dossier::where('service_id', '=', auth()->user()->service_id)->where('traiter', false)->paginate(20);
    }


    public function save(Dossier $dossier)
    {
        $dossier->is_delete=false;
        return $dossier->save();
    }


    public function coter(Dossier $dossier, Service $service)
    {
        $dossier->service_id=$service->id;
        return $dossier->update();
    }
}
