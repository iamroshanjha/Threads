<?php

namespace Threads;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  public function posts(){
    return $this->hasMany('Threads\Post');
  }

  public function likes(){
        return $this->belongsTo('Threads\User');
    }

    public function category(){
    return $this->belongsTo('Threads\Categories');
  }


  

}
