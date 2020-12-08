<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $fillable = [
       'nom'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
