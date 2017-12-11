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
      $data=quantity_per_item($item_id);
      return $data['current_amount'];

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
