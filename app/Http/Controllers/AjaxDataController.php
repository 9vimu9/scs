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

    public function suggest(Request $request)
    {
        $term = trim($request->q);
        $table = trim($request->t);
        $column = trim($request->c);
        $type = trim($request->type);// NOTE: null means selectboxsuggestion 0 means where qury result

        if (empty($term)) {
            return \Response::json([]);
        }

        $results = array();
        if(strlen($type)==0){//select box suggestion
          $results =  DB::table($table)->where($column, '=', $term)->orWhere($column, 'LIKE', '%' . $term . '%')->get(['id', $column.' as value']);
        }
          else {
          $results =  DB::table($table)->where($column, '=', $term)->get();
        }
        return response()->json($results);
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
