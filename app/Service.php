<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ServiceSeeder;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'servicegeneral_id', 'english'
    ];


    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, "service_id");
    }

    public function servicegenerals()
    {
        return $this->belongsTo(ServiceGeneral::class, 'servicegeneral_id', 'id');
    }

    public function cotation()
    {
        return $this->hasMany(Cotation::class, "id_service");
    }

    public function user()
    {
        return $this->belongsToMany(User::class, "service_id");
    }

    public function traces()
    {
        return $this->belongsToMany(Traces::class, "service_id");
    }

}
