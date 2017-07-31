<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class huts extends Model
{
  public function item()// NOTE: this method get details of hut in the items table
  {
      return $this->belongsTo('App\item');
  }

  public function hut_items()
  {
      return $this->hasMany('App\hut_items','hut_id');
  }

   public function items()// NOTE: this get the details of items that hut object created
  {
      return $this->belongsToMany('App\item','hut_items','id','hut_id')->withPivot('amount','id','created_at','updated_at');
  }


}
