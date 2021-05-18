<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDossier extends Model
{
  protected $fillable = [
      'name', 'description',
  ];

  public function dossiers(){
    return $this->hasMany(Dossier::class);
  }
}
