<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //  public function items()
    // {
    //     return $this->hasMany('App\item_orders');
    // }

    public function supplier(){
        return $this->belongsTo("App\Supplier");
    }

    public function item_order()
    {
        return $this->hasMany('App\item_orders');
    }
}
