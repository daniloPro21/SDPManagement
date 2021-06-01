<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorderauDossier extends Model
{
    protected $fillable = ["id_dossier","id_borderaux"];

    public function dossiers()
    {
        return $this->belongsTo(Dossier::class, "id_dossier");
    }

    public function bordereau()
    {
        return $this->belongsTo(BorderauDossier::class, "id_borderaux");
    }
}
