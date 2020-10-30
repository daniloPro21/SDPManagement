<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
  protected $fillable = [
      'type', 'action_date','message','dossier_id','user_id'
  ];


  public function dossier()
  {
    return $this->belongsTo(Dossier::class,"dossier_id");
  }
  public function user()
  {
    return $this->belongsTo(User::class,"user_id");
  }
}
