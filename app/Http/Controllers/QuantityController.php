<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item;
use Illuminate\Support\Facades\DB;


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
      $item_initial_quantity = DB::table('items')
                                  ->where('id', '=', $item_id)
                                  ->value('initial_quantity');
        // $item_grn_amount = DB::table('item_grns')->select(DB::raw('sum(amount-rejected) as grn_amount'))
        //              ->where('item_id', '=', $item_id)
        //              ->groupBy('item_id')
        //              ->value('grn_amount');
        //
        // $item_sale_amount = DB::table('sale_items')->select(DB::raw('sum(amount) as sale_amount'))
        //              ->where('item_id', '=', $item_id)
        //              ->groupBy('item_id')
        //              ->value('sale_amount');


        $item_stock_amount=$item_initial_quantity;
        //$item_grn_amount-($item_sale_amount);
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













}
