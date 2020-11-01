<?php

namespace App\Repositories;

use App\Dossier;
use App\Service;

class ServiceRepository
{
    public function getAllService()
    {
        return Service::all();
    }

    public function getServiceById($idservice)
    {
        return Services::where('id', $idpersonne)->get();
    }
}
