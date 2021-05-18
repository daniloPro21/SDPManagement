<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGeneral extends Model
{
    protected $fillable = ['name', 'description'];

    public function services()
    {
        return $this->hasMany(Service::class, 'servicegeneral_id');
    }
}
