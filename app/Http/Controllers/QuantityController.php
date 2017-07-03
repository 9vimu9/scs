<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;
use Illuminate\Support\Facades\DB;

class QuantityController extends Controller
{
   

    public function CheckQuantity(Request $request)
    {
        
        $item_id = trim($request->q);
        

        if (empty($item_id)) {
            return \Response::json([]);
        }



       //your logic here babe
        //  $item=Item::find($item_id);
        //   return response()->json( $item->reorder);
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
}
