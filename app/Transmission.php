<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    protected $fillable = ['service', 'analyse', 'observation','etat', 'numero', 'date', 'service_id', 'is_delete', "entete"];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'id_dossier');
    }

    public function service()
    {
        return $this->belongsTo(ServiceGeneral::class, 'service_id');
    }
}
