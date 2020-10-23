<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $fillable = [
      'type', 'action_date','message','dossier_id',
  ];


  public function dossier()
  {
    return $this->belongTo(Dossier::class,"dossier_id");
  }
}
