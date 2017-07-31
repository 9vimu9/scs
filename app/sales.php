<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    public function customer(){
        return $this->belongsTo("App\customer");
    }

    public function sale_item()
    {
        return $this->hasMany('App\sale_item','sale_items');
    }

     public function items()
    {
        return $this->belongsToMany('App\item',"sale_items","sale_id")->withPivot('amount','sale_id', 'item_id','id','created_at','updated_at');
    }
}
