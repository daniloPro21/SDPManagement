<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{


    protected $fillable = [
      'nom', 'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

}
