<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class items_reportrequest extends Model
{
   public function item()
    {
        return $this->belongsTo('App\item');
    }
}
