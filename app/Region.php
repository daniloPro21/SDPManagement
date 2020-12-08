<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    protected $fillable = [
        'nom'
    ];

    public function district()
    {
        return $this->hasMany(District::class, 'district_id');
    }

}
