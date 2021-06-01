<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotation extends Model
{
    protected $fillable = ["id_service","id_dossier","service_generals_id"];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class, "id_dossier");
    }

    public function service()
    {
        return $this->belongsTo(Service::class, "id_service");
    }
    public function servicegeneral()
    {
        return $this->belongsTo(ServiceGeneral::class, "service_generals_id");
    }
}
