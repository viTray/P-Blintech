<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class General extends Model
{
    protected $guarded = ['id'];
    public function reception()
    {
        return $this->belongsTo('App\Reception', 'idReception');
    }
    public function type()
    {
        return $this->belongsTo('App\Type', 'idType');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'idBrand');
    }
}
