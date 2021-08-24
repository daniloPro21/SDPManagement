<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Dossier extends Model
{
    use Notifiable;


    protected $fillable = [
        'service_id', 'num_courrier', 'date_entre', 'telephone', 'date_sortie', 'note', 'num_drh', 'statut',
        'type_id', 'nom', 'prenom', 'matricule', 'grade', 'sous_service_id'];

    public function Type()
    {
        return $this->belongsTo(TypeDossier::class, "type_id", "id");
    }

    public function ServiceGeneral()
    {
        return $this->hasMany(ServiceGeneral::class);
    }

    public function cotation()
    {
        return $this->hasMany(Cotation::class);
    }
    public function Tracage(){
        return $this->hasMany(Tracage::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class, "dossier_id", 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->hasMany(Service::class);
    }

    public function delegues()
    {
        return $this->belongsTo(Delegue::class, 'id_dossier');
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
