<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class returning_item extends Model
{
  public function sale_item()
  {
    return $this->belongsTo('App\sale_item');
  }
}
