<?php

namespace App\Repositories;

use App\Cotation;
use App\Dossier;
use App\Service;
use Illuminate\Support\Facades\DB;

class DossierRepository
{
    public function getDossiers()
    {
        return Dossier::with('type','service')->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getNonCoterDossiers()
    {
        return Dossier::join("cotations", 'cotations.dossier_id', '!=', 'dossiers.id')
            ->where("dossiers.statut",null)
            ->select('dossiers.*')
            ->get();
            //Dossier::where('service_id', '=', NULL)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getAdminDossierSigne()
    {
        return Dossier::with('type','service')->where('statut', 'signe')->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getAdminDossierRejete()
    {
        return Dossier::with('type','service')->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getAdminDossierTransmis()
    {
        return Dossier::with('type','service')->where('statut', 'transmis')->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }
    public function getNewDossiers()
    {
        return Dossier::with('type','service','services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('sous_service_id', '=', null)
            ->where('statut', '=', 'encour')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);

    }

    public function getAssignDossiers()
    {
        return Dossier::join("cotations", 'cotations.dossier_id', '=', 'dossiers.id')
            ->where("dossiers.statut", "encour")
            ->select('dossiers.*')
            ->distinct()
            ->get();
    }
    public function getAssignAdminDossiers()
    {
        return Cotation::with('dossier', 'service')->paginate(21);
    }




    public function getDossiersTraiter()
    {
        return Dossier::with('type')->where('statut', '=', 'traiter')->where('service_id', '=' ,auth()->user()->service_id)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }
    public function getDossiersTraiterSuper()
    {
        return Dossier::with('type')->where('statut', '=', 'traiter')->where('service_id', '!=' ,null)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }
    public function getDossiersTraiterAdministrator()
    {
        return Dossier::with('type')->where('statut', '=', 'traiter')->where('service_id', '=' ,auth()->user()->service_id)->where('is_delete', false)->orderByDesc('id')->paginate(21);
    }

    public function getSignesAdmin()
    {
       return Dossier::with('type','service','services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('statut','=', 'signe')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);
    }

    public function getRejetesAdmin()
    {
       return Dossier::with('type','service','services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('statut', '=', 'rejete')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);
    }

    public function getTransmissAdmin()
    {
       return Dossier::with('type','service','services')
            ->where('service_id', '=', auth()->user()->service_id)
            ->where('statut', '=', 'transmis')
            ->where('is_delete', false)
            ->orderByDesc('id')->paginate(21);
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
