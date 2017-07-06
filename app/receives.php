<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receives extends Model
{
    public function order(){
        return $this->belongsTo("App\order");
    }

    public function item_receive()
    {
        return $this->hasMany('App\item_receives','id','receive_id');
    }

     public function items()
    {
        return $this->belongsToMany('App\item','item_receives','receive_id')->withPivot('amount','rejected','id','created_at','updated_at','precentage');
    }
}
