<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    protected $fillable = ["date","personnel_id","poste_id","fiche_affectation_id","motif"];


    public function  personnel(){
        return $this->belongsTo(Personnel::class,"Personnel_id");
    }

    public function  poste(){
        return $this->belongsTo(Poste::class,"poste_id");
    }

    public  function  ficheAffection(){
        return $this->belongsTo(FicheAffectation::class,"fiche_affectation_id");
    }
}
