<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    protected $guarded = ['id'];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'idCustomer');
    }
    public function delivered()
    {
        return $this->hasMany('App\Delivered', 'idReception');
    }
    public function images()
    {
        return $this->hasMany('App\ReceptionImage', 'idReception');
    }
    public function accessorys()
    {
        return $this->hasMany('App\Accessory', 'idReception');
    }
    public function exteriors()
    {
        return $this->hasMany('App\Exterior', 'idReception');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment', 'idReception');
    }
    public function general()
    {
        return $this->hasMany('App\General', 'idReception');
    }
}
