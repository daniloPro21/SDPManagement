<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
        protected $fillable = ['num_dossier', 'id_dossier', 'id_service', 'date_sortie', "num_service"];


    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'id_dossier');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}
