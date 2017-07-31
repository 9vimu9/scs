<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotation_item extends Model
{
     public function item(){
        return $this->belongsTo("App\item");
    }

    public function quotation(){
       return $this->belongsTo("App\quotation");
   }
}
