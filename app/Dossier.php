<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dossier extends Model
{
    use Notifiable;


    protected $fillable = [
      'date_entre', 'telephone', 'date_sortie','note','num_drh','traiter','type_id','nom','prenom','matricule','grade'
  ];


  public function Type(){
    return $this->belongsTo(TypeDossier::class,"type_id", "id");
  }

  public function service(){
    return $this->belongsTo(ServiceGeneral::class,"service_id", 'id');
  }

    public function steps()
    {
        return $this->hasMany(Step::class, "dossier_id", 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cotation()
    {
        return $this->belongsTo(Cotation::class, 'id_dossier');
    }
}
