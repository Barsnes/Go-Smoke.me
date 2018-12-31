<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function smoke(){
      return $this->hasMany('App\Smoke');
    }

    public function vote(){
      return $this->belongsToMany('App\Smoke', 'votes', 'smoke_id', 'user_id');
    }
}
