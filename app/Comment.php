<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id','body','user_id','post_id'];

    protected $table = 'comments'; 

    /**
     * Get user record associated with the comment
     */
    public function user ()
    {
        return $this->hasOne('App\User');
    }

}
