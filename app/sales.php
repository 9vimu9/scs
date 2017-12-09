<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{

    public function quotation(){
      return $this->belongsTo("App\quotation");
    }

    public function user(){
        return $this->belongsTo("App\user");
    }

    public function sale_item()
    {
        return $this->hasMany('App\sale_item','sale_id');
    }

     public function items()
    {
        return $this->belongsToMany('App\item',"sale_items","sale_id")->withPivot('amount','unit_price','amount','sale_id','total', 'item_id','id','created_at','updated_at','user_id');
    }
}
