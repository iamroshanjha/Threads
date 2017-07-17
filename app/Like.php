<?php

namespace Threads;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use Notifiable;


    protected $table = 'likes'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reply_id', 'user_id', 'likes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

  public function replies(){
    return $this->belongsTo('Threads\Reply');
  }

  public function user(){
        return $this->belongsTo('Threads\User');
    }

}
