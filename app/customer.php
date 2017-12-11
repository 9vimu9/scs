<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
  public function quotations()
  {
      return $this->hasMany('App\quotation');
  }
}
