<?php

namespace Threads;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use Notifiable;

    protected $table = 'categories'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function posts(){
    return $this->hasMany('Threads\Post');
  }

  public function user(){
        return $this->hasMany('Threads\User');
    }
}
