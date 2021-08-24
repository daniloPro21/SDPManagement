<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','service_id','is_delete','sous_service_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, "sous_service_id");
    }
    public function general()
    {
        return $this->belongsTo(ServiceGeneral::class, "service_id");
    }

    public function delegues()
    {
        return $this->belongsTo(Delegue::class, 'id_user');
    }
    public function cotation()
    {
        return $this->hasMany(Cotation::class);
    }
}
