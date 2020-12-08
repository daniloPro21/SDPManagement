<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FicheAffectation extends Model
{
    protected $fillable = ["type","etat","numero_decision","date","titre","decision"];



    public  function  affectations(){
        return $this->hasMany(Affectation::class,"fiche_affectation_id");
    }
}
