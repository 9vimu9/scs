<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issue_item extends Model
{
     public function item(){
        return $this->belongsTo("App\item");
    }
}
