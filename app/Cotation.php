<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotation extends Model
{
    protected $fillable = ["num_dossier", "id_service","id_dossier"];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, "id_dossier");
    }

    public function service()
    {
        return $this->belongsTo(Service::class, "id_service");
    }
}
