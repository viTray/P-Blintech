<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = ['id'];

    public function delivereds()
    {
        return $this->hasMany('App\Deliverd', 'idEmployee');
    }
}
