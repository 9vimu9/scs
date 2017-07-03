<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loanissuereturns extends Model
{
    public function loanissue(){
        return $this->belongsTo("App\loanissues","loanissue_id");
    }

    public function item_loanissuereturn()
    {
        return $this->hasMany('App\item_loanissuereturn','id','loanissuereturn_id');
    }

     public function items()
    {
        return $this->belongsToMany('App\item','item_loanissuereturns','loanissuereturn_id')->withPivot('amount','rejected','id','created_at','updated_at');
    }
}
