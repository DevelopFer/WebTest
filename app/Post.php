<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    /*
        Retrieve the user who published this post
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->morphToMany('App\Tag', 'taggable');
    }

}
