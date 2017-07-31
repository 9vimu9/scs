<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grns extends Model
{
    public function order(){
        return $this->belongsTo("App\order");
    }

    public function item_grn()
    {
        return $this->hasMany('App\item_grns','id','grn_id');
    }

     public function items()
    {
        return $this->belongsToMany('App\item','item_grns','grn_id')->withPivot('amount','id','created_at','updated_at');
    }
}
