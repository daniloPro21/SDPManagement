<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $fillable = [
       'nom', 'region_id'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function  structures(){
        return $this->hasMany(Structure::class);
    }

}
