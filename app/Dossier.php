<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dossier extends Model
{
    use Notifiable;


    protected $fillable = [
      'date_entre', 'telephone', 'date_sortie','note','num_drh','statut','type_id','nom','prenom','matricule','grade','sous_service_id'
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

    public function services()
    {
        return $this->belongsTo(Service::class, 'sous_service_id');
    }

    public function delegues()
    {
        return $this->belongsTo(Delegue::class,'id_dossier');
    }

    public function track()
    {
        return $this->belongsTo(Trace::class, 'id_dossier', 'id');
    }

    public function transmission()
    {
        return $this->belongsTo(transmission::class, 'id_dossier', 'id');
    }
}
