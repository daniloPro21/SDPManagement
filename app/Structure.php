<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{


    protected $fillable = [
        'nom'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

}
