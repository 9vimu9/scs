<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item_orders extends Model
{
    public function item()
    {
        return $this->belongsTo('App\item');
    }
}
