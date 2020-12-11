<?php

namespace App\Models;

use App\Structure;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    protected $fillable = ["date","personnel_id","poste_id","structure_id","fiche_affectation_id","motif"];


    public function  personnel(){
        return $this->belongsTo(Personnel::class,"personnel_id");
    }

    public function  structure(){
        return $this->belongsTo(Structure::class,"structure_id");
    }

    public function poste(){
        return $this->belongsTo(Poste::class,"poste_id");
    }

    public  function  ficheAffection(){
        return $this->belongsTo(FicheAffectation::class,"fiche_affectation_id");
    }
}
