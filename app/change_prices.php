<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class change_prices extends Model
{
  public function item()
  {
      return $this->belongsTo('App\item','item_id');
  }

  public function user()
  {
      return $this->belongsTo('App\User');
  }
}
