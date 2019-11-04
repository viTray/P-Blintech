<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exterior extends Model
{
    protected $guarded = ['id'];
    public function reception()
    {
        return $this->belongsTo('App\Reception', 'idReception');
    }
    public function title()
    {
        return $this->belongsTo('App\Title', 'idTitle');
    }
}
