<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracage extends Model
{
    protected $fillable = ["serviceB", "serviceA", "motif","dossier_id"];

    public function dossier(){
        return $this->belongsTo(Dossier::class);
    }
}
