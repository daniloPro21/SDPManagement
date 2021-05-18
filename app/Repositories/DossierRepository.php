<?php

namespace App\Repositories;

use App\Dossier;
use App\Service;

class DossierRepository
{
    public function getDossiers()
    {
        return Dossier::with('type','service')->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getNonCoterDossiers()
    {
        return Dossier::with('type','service')->where('service_id', null)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getNewDossiers()
    {
        return Dossier::with('type','service')->where('service_id', auth()->user()->service_id)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getAssignDossiers()
    {
        return Dossier::with('type')
            ->where('service_id', '!=', null)
            ->where('is_delete', false)
            ->orderByDesc('id')
            ->where('traiter', false)
            ->get();
    }

    public function getDossiersTraiter()
    {
        return Dossier::with('type')->where('traiter', true)->where('service_id', auth()->user()->service_id)->where('is_delete', false)->orderByDesc('id')->paginate(21);
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
