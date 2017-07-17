<?php

namespace Threads;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class ReplyThread extends Model
{
    use Notifiable;

    protected $table = 'replies_thread'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['reply_id','body'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function post(){
        return $this->belongsTo('Threads\Post');
    }

    public function user(){
        return $this->belongsTo('Threads\User');
    }

    public function likes(){
    return $this->hasMany('Threads\Like');
  }

  public function replies(){
        return $this->belongsTo('Threads\Reply');
    }

}
