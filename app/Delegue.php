<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegue extends Model
{
    protected $fillable = ['id_dossier', 'id_user'];


    public function dossiers()
    {
        return $this->belongsTo(Dossier::class, 'id_dossier');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
