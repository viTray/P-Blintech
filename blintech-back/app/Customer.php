<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    public function receptions()
    {
        return $this->hasMany('App\Reception', 'idCustomer');
    }
}
