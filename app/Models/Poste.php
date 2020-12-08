<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    protected $fillable = ["nom","description"];

    public  function  affectations(){
        return $this->hasMany(Affectation::class,"poste_id");
    }
}
