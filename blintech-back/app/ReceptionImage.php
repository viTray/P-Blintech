<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceptionImage extends Model
{
    protected $guarded = ['id'];

    public function reception()
    {
        return $this->belongsTo('App\Reception', 'idReception');
    }
}
