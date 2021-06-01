<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DossierTransmi extends Model
{
    protected $fillable = ['id_dossier', 'transmission_id'];

    public function dossiers()
    {
        return $this->belongsTo(Dossier::class, 'id_dossier', 'id');
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class, 'transmission_id', 'id');
    }


}
