<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dossier extends Model
{
    use Notifiable;

    
    protected $fillable = [
      'date_entre', 'telephone', 'date_sortie','note','num_dra','num_sdp','traiter','type_id','nom','prenom','matricule','grade'
  ];


  public function type(){
    return $this->belongsTo(TypeDossier::class,"type_id");
  }

  public function service(){
    return $this->belongsTo(Service::class,"service_id");
  }

    public function steps()
    {
        return $this->hasMany(Step::class, "dossier_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
