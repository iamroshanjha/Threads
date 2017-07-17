<?php

namespace Threads;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Reply extends Model
{
    use Notifiable;
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'post_id'
            ]
        ];
    }


    protected $table = 'replies'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = ['post_id','body'];

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

  public function repliesthread(){
    return $this->hasMany('Threads\ReplyThread');
  }

}
