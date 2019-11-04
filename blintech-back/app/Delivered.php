<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivered extends Model
{
    protected $guarded = ['id'];
    public function reception()
    {
        return $this->belongsTo('App\Reception', 'idReception');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'idEmployee');
    }
}
