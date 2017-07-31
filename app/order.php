<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //  public function items()
    // {
    //     return $this->hasMany('App\item_orders');
    // }


    public function grn()
    {
        return $this->hasOne('App\grns');
    }

    public function supplier(){
        return $this->belongsTo("App\Supplier");
    }

    public function item_order()
    {
        return $this->hasMany('App\item_orders');
    }

     public function items()
    {
        return $this->belongsToMany('App\item','item_orders')->withPivot('amount', 'unit_price','id','created_at','updated_at');
    }
}
