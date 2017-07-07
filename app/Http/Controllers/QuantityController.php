<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item;
use Illuminate\Support\Facades\DB;
use App\reportrequest;//requests table eka 

class QuantityController extends Controller
{
   

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
          //  return "this month ".$request->selected_ids;
            $report_id= $this->GetMonthlyReportId();

        } 
        else if($request->btn_quick){
             $report_id= $this->CreateQuickReport();
             
        }


       return redirect('/requestselected/'.$report_id.'/'.$selected_items_for_report);
    }

    public function GetMonthlyReportId()
    {
     
       $request_report_id = reportrequest::
                            whereYear('created_at', '=',date('Y'))
                            ->whereMonth('created_at', '=', date('m'))
                            ->where('type', 1)
                            
                            ->pluck('id');


        if(count($request_report_id)>0){
           return $request_report_id;
       
        }
        else{
            $reportrequest=new reportrequest();
            $reportrequest->type=1;//1 motnhly report
            $reportrequest->save();
            return  $reportrequest->id;

        //     return redirect('/items/')->with('success','successfully saved');

        }
    }

    public function CreateQuickReport()
    {
            $reportrequest=new reportrequest();
            $reportrequest->type=0;//0 quick report
            $reportrequest->save();
            return  $reportrequest->id;
        
        
    }

}




      
 