<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [
        'id',
        'remember_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function date()
    {
        return $this->hasOne('App\Date');
    }

    public function config()
    {
        return $this->hasOne('App\Config');
    }
}
