<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
  protected $fillable = [
      'date_entre','date_sortie','note','num_dra','num_sdp','num_service','traiter', 'service_id','personne_id','type_id',
  ];


  public function type(){
    return $this->belongsTo(TypeDossier::class,"type_id");
  }

  public function personne(){
    return $this->belongsTo(Personne::class,"personne_id");
  }

  public function service(){
    return $this->belongsTo(Service::class,"service_id");
  }

  public function steps(){
    return $this->hasMany(Step::class,"dossier_id");
  }
}
