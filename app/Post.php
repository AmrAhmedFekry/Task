<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['id','title','body','user_id'];

    protected $table = 'posts'; 

    /**
     * Get commment record associated with the post
     */
    public function comment ()
    {
        return $this->hasMany('App\Comment');
    }
}
