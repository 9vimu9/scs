<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item_loanissue extends Model
{
     public function item(){
        return $this->belongsTo("App\item");
    }
}
