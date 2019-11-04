<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];
    public function reception()
    {
        return $this->belongsTo('App\Reception', 'idReception');
    }
    public function images()
    {
        return $this->hasMany('App\CommentImage', 'idComment');
    }
}
