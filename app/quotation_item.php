<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotation_item extends Model
{
     public function item(){
        return $this->belongsTo("App\item");
    }
}
