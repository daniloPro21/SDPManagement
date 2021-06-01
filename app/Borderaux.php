<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borderaux extends Model
{
    protected $fillable= ["titre","numero", "destinataire", "observation", "date","etat", "service_id","is_delete","entete"];

    public function service()
    {
        return $this->belongsTo(ServiceGeneral::class, "service_id");
    }
}
