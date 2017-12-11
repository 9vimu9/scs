<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sale_item extends Model
{
     public function item(){
        return $this->belongsTo("App\item");
    }

    public function sale(){
       return $this->belongsTo("App\sales");
   }

   public function returning_item(){
      return $this->hasOne('App\returning_item');
  }



}
