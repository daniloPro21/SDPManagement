<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $fillable = ["nom","prenom","matricule","sexe","date_naissance","grade","telephone"];


    public  function  affectations(){
        return $this->hasMany(Affectation::class,"personnel_id");
    }
}
