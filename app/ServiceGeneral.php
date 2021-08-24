<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGeneral extends Model
{
    protected $fillable = ['name', 'description', 'english'];

    public function services()
    {
        return $this->belongsTo(Service::class, 'servicegeneral_id');
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class, 'service_id');
    }

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function cotation()
    {
        return $this->hasMany(Cotation::class);
    }

}
