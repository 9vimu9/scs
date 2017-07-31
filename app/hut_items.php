<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hut_items extends Model
{
  public function item()
  {
      return $this->belongsTo('App\item');
  }

}
