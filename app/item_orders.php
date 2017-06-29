<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item_orders extends Model
{
   public function order(){
        return $this->belongsTo("App\order");
    }
}
