<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotation extends Model
{
    protected $fillable = ["service_id","dossier_id","servicegeneral_id", "user_id"];


    public function dossiers()
    {
        return $this->belongsTo(Dossier::class, "dossier_id");
    }

    public function services()
    {
        return $this->belongsTo(Service::class, "service_id");
    }
    public function servicegeneral()
    {
        return $this->belongsTo(ServiceGeneral::class, "servicegeneral_id");
    }

    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
