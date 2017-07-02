<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loanissues extends Model
{
      public function officer(){
        return $this->belongsTo("App\officer");
    }

    public function item_loanissue()
    {
        return $this->hasMany('App\item_loanissue','item_loanissue');
    }

     public function items()
    {
        return $this->belongsToMany('App\item',"item_loanissue","	loanissue_id")->withPivot('amount','issue_id', 'item_id','id','created_at','updated_at');
    }
}
