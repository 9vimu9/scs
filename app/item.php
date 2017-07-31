<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{

     public function cat()
    {
        return $this->belongsTo('App\cat');
    }

    public function prices()
   {
       return $this->hasMany('App\change_prices');
   }


}
