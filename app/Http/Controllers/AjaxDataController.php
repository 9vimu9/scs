<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\change_prices;
class AjaxDataController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
    }


     public function GetSingleValue(Request $request)
     {

        $id = trim($request->q);
        $column = trim($request->c);
        $table = trim($request->t);


        if (empty($id)) {
            return \Response::json([]);
        }
        return DB::table($table)->select(DB::raw($column))->where("id", '=', $id)->value($column);

    }

    public function GetLatestPrice(Request $request)
    {
       $item_id = trim($request->q);
       if (empty($item_id)) {
         return \Response::json([]);
       }

      $last_price=change_prices::where('item_id', $item_id)->latest()->first()->price;

      return $last_price;
    }




}
