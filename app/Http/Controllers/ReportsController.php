<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\reportrequest;
use App\order;
use App\receives;
use App\issues;

class ReportsController extends Controller
{
    public function ShowMonthlyRequestReport($id)
    {
        $reportrequest= reportrequest::find($id);
       
        return view('reports.request_monthly')->with("reportrequest",$reportrequest); 

    
    }

    public function ShowOrderReport($id)
    {
        $order= order::find($id);
       
        return view('reports.order')->with("order",$order); 

    
    }

     public function ShowGrnReport($id)
    {
        $receive= receives::find($id);
       
        return view('reports.grn')->with("receive",$receive); 

    
    }

    public function ShowIssueReport($id)
    {
        $issue= issues::find($id);
       
        return view('reports.issue')->with("issue",$issue); 

    
    }
}
