<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\change_prices;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;



class ChangePricesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {

      // $data=change_prices::groupBy('item_id')->orderBy('created_at', 'desc')->get();
      $data=change_prices::whereRaw('id IN (select MAX(id) FROM change_prices GROUP BY item_id)')->get();
//die($data);
      return view('items.change_price')->with("item_prices",$data);
  }

  public function getItemPriceHistory(Request $request)
  {
    $item_id = trim($request->item_id);


    if (empty($item_id)) {
        return \Response::json([]);
    }
    //
    $results = array();
    $results = DB::table("change_prices")->select('created_at','price')->where('item_id', $item_id) ->orderBy('created_at', 'asc')->get();
//  die($results);
    return response()->json($results);
  }



  public function store(Request $request)
  {
  //  return "gfgg";
    $change_price=new change_prices();
    $validator = Validator::make($request->all(), [
        'price'=>'required|numeric',
        'item_id' => 'required'
    ]);
    if (!$validator->fails()){
        $change_price->price=$request['price'];
        $change_price->item_id=$request['item_id'];
        $change_price->user_id=Auth::user()->id;
        $change_price->save();
        return response ()->json ( $change_price );

    }
    else{
      return \Response::json(array(
              'errors' => $validator->getMessageBag()->toArray()
      ) );
    }
  }


}
