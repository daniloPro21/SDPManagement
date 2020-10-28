<?php

namespace App\Repositories;

use App\Dossier;
use App\Personne;

class PersonneRepository
{
    public function getAllPersonne()
    {
        return Personne::all();
    }

    public function getDossierbyPersonneID($idpersonne)
    {
        return Dossier::where('personne_id', $idpersonne)->get();
    }
}