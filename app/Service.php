<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $fillable = [
      'name', 'description',
  ];


  public function dossiers(){
    return $this->hasMany(Dossier.class,"service_id");
  }

  public function users(){
    return $this->hasMany(User.class,"service_id")
  }
}
