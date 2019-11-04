<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentImage extends Model
{
    protected $guarded = ['id'];

    public function comment()
    {
        return $this->belongsTo('App\Comment', 'idComment');
    }
}
