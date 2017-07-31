<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\order;
use App\grns;
use App\sales;

class ReportsController extends Controller
{


    public function ShowOrderReport($id)
    {
        $order= order::find($id);

        return view('reports.order')->with("order",$order);


    }

     public function ShowGrnReport($id)
    {
        // $grn= grns::find($id);
        //
        // return view('reports.grn')->with("grn",$grn);
        return "under modification";


    }

    public function ShowSaleReport($id)
    {
        $sale= sales::find($id);

        return view('reports.sale')->with("sale",$sale);


    }
}
