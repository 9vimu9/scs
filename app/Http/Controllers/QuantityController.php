<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item;
use Illuminate\Support\Facades\DB;
use App\reportrequest;//requests table eka 

class QuantityController extends Controller
{

       public function __construct()
    {
        $this->middleware('auth');
    }
   

    public function CheckQuantity(Request $request)
    {      
        $item_id = trim($request->q);
     
        if (empty($item_id)) {
            return \Response::json([]);
        }
       return $this->QuanitiyPerItem($item_id);
    }




    public function QuanitiyPerItem($item_id)
    {
        $item_receive_amount = DB::table('item_receives')->select(DB::raw('sum(amount-rejected) as receive_amount'))
                     ->where('item_id', '=', $item_id)
                     ->groupBy('item_id')
                     ->value('receive_amount');
        
        $item_issue_amount = DB::table('issue_items')->select(DB::raw('sum(amount) as issue_amount'))
                     ->where('item_id', '=', $item_id)
                     ->groupBy('item_id')
                     ->value('issue_amount');

        $item_loanissue_amount = DB::table('item_loanissues')->select(DB::raw('sum(amount) as loanissue_amount'))
                     ->where('item_id', '=', $item_id)
                     ->groupBy('item_id')
                     ->value('loanissue_amount');

        $item_loanissue_amount = DB::table('item_loanissuereturns')->select(DB::raw('sum(amount-rejected) as receive_amount'))
                     ->where('item_id', '=', $item_id)
                     ->groupBy('item_id')
                     ->value('receive_amount');
        $item_stock_amount=$item_receive_amount+$item_loanissue_amount-($item_issue_amount+$item_loanissue_amount);
        return $item_stock_amount;
    }



     public function GetCurrentStore()
    {      
        $items = item::all();
        foreach($items as $item) 
        {
            $item['current']=$this->QuanitiyPerItem($item->id);

        }
        
          return view('stores.current')->with("items",$items); 


    }


    public function GetDataSelectedForReport(Request $request)
    {
        $selected_items_for_report= $request->selected_ids;
        $report_id=0;
       
        if($request->btn_this_month){
         
            $report_id= $this->GetMonthlyReportId();
          
        } 
        else if($request->btn_quick){
             $report_id= $this->CreateReport_GetId(0);
             
        }
 
        session(['selected_items_for_report' => $selected_items_for_report]);

        return redirect('/requestselected/'.$report_id);
    }

    public function GetMonthlyReportId()
    {
     
       $request_report_id = reportrequest::
                            whereYear('created_at', '=',date('Y'))
                            ->whereMonth('created_at', '=', date('m'))
                            ->where('type', 1)
                            ->pluck('id');


        if(count($request_report_id)>0){
           return $request_report_id[0];
        }
        else{
           
            return  $this->CreateReport_GetId(1);//monthly report

        }
    }

    public function CreateReport_GetId($type){
      
        $reportrequest = reportrequest::create(['type'=>$type]);
        $last = DB::table('reportrequests')->latest()->get();
        $arr=get_object_vars($last[0]);
        //  print_r($arr["id"]);
        return $arr["id"];
          
    }

    public function DestroyRequestReport($id)
    {
        $reportrequest=reportrequest::find($id);
        $reportrequest->delete();
        return redirect('/request_report_list')->with('success',"remove report");
 
    }

    public function AllRequestReports()
    {
       // return "sdmhsdgjl";
       $reportrequests=reportrequest::OrderBy('created_at','desc')->paginate(8);
        
        return view('stores.requestreportlist')->with("reportrequests",$reportrequests);
    }



}




      
 