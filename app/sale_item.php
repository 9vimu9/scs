<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sale_item extends Model
{
     public function item(){
        return $this->belongsTo("App\item");
    }
}
