<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
  protected $fillable = [
      'nom', 'prenom','matricule','grade',
  ];


  public function dossiers(){
    return $this->hasMany(Dossier::class,"personne_id");
  }
}
