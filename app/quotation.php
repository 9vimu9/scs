<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotation extends Model
{
  public function customer(){
      return $this->belongsTo("App\customer");
  }

  public function quotation_item()
  {
      return $this->hasMany('App\quotation_item');
  }

  public function items()
 {
     return $this->belongsToMany('App\item','quotation_items')->withPivot('amount','id','created_at','updated_at');
 }
}
