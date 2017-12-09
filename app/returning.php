<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class returning extends Model
{


 public function sale()
 {
   return $this->belongsTo('App\sales');
 }
}
