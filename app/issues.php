<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issues extends Model
{
     public function officer(){
        return $this->belongsTo("App\officer");
    }

    public function issue_item()
    {
        return $this->hasMany('App\issue_item','issue_item');
    }

     public function items()
    {
        return $this->belongsToMany('App\item',"issue_item","issue_id")->withPivot('amount','issue_id', 'item_id','id');
    }
}
