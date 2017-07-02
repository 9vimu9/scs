<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function orders()
    {
        return $this->belongsToMany('App\order','item_orders')->withPivot('amount', 'unit_price','id','created_at','updated_at');
    }
}
