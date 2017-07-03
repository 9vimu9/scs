<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loanissues extends Model
{
    public function loanissuereturn()
    {
        return $this->hasOne('App\loanissuereturns',"loanissue_id");
    }

      public function officer(){
        return $this->belongsTo("App\officer");
    }

    public function item_loanissue()
    {
        return $this->hasMany('App\item_loanissue','item_loanissues');
    }

     public function items()
    {
        return $this->belongsToMany('App\item',"item_loanissues","loanissue_id")->withPivot('amount','loanissue_id', 'item_id','id','created_at','updated_at','return_date');
    }
}
