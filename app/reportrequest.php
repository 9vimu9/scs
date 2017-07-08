<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reportrequest extends Model
{
   protected $fillable = ['type'];
    protected  $primaryKey = 'id';

     public function items_reportrequest()
    {
        return $this->hasMany('App\items_reportrequest');
    }

     public function items()
    {
        return $this->belongsToMany('App\item','items_reportrequests')->withPivot('requested_amount', 'amount_in_store','id','created_at','updated_at');
    }
}
