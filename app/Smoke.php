<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smoke extends Model
{
  public function user(){
    return $this->belongsTo('App\User');
  }

  public function vote(){
    return $this->belongsToMany('App\User', 'votes', 'smoke_id', 'user_id');
  }

}
