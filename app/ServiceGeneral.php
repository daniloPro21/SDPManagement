<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGeneral extends Model
{
    protected $fillable = ['name', 'description', 'english'];

    public function services()
    {
        return $this->hasMany(Service::class, 'servicegeneral_id');
    }


    public function transmission()
    {
        return $this->belongsTo(Transmission::class, 'service_id');
    }
}
