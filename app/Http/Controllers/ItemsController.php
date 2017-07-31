<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item;
use App\cat;
use App\item_orders;
use App\item_grns;
use App\sale_item;
use App\huts;

use Illuminate\Support\Facades\DB;
use Auth;
use Validator;


class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


 public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data=item::OrderBy('updated_at','desc')->get();

        return view('items.index')->with("all_items",$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("items.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item=new item();
        $val=  $this->AddUpdateCore($item,$request);
        if ($val->fails()){

          return redirect()->back()->withErrors($val)->withInput();

        }
        else{
            DB::table('change_prices')->insert(
              [
                'item_id' => $item->id,
                'price' => 0,
                'user_id'=>Auth::user()->id,
                'created_at'=>$item->created_at,
                'updated_at'=>$item->updated_at
              ]
            );
            return redirect('/items/create')->with('success','successfully saved');

          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data_o = item_orders::select(DB::raw('"1o" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,order_id as id,amount,created_at'))
                    ->where('item_id', '=', $id);

                   //  DATE_FORMAT(created_at, "%Y/%l/%d")

        $data_r = item_grns::select(DB::raw('"2r" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,grn_id as id,(amount-rejected)as amount,created_at'))
                    ->where('item_id', '=', $id);

        $logs = sale_item::select(DB::raw('"5i" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,sale_id as id,(amount)as amount,created_at'))
                    ->where('item_id', '=', $id)
                    ->union($data_r)
                    ->union($data_o)
                    ->union($data_li)
                    ->union($data_lir)
                    ->orderBy('created_at')
                    ->orderBy('type')
                    ->get();

//return $logs;

        return view("items.log")->with(['logs'=>$logs,'item'=>item::find($id)]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=item::find($id);
        return view("items.edit")->with('item',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item=item::find($id);
        $val=  $this->AddUpdateCore($item,$request);
        if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect('/items/')->with('success','successfully updated');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $item=item::find($id);

        $item->delete();
        if($item->ishut>0){

          $hut=huts::find($item->ishut);// NOTE: when ishut>0 means it is pk of huts
          $hut->delete();


        }
        return redirect('/items')->with('success',"item<strong> $item->name </strong>removed successfully");



    }
    private function AddUpdateCore($item,$request)
    {

        $validator = Validator::make($request->all(), [
            'name'=>"required",
            'initial_quantity'=>"required|numeric",
            'cat_id'=>"required|numeric"
        ]);
        if (!$validator->fails()){

            $item->name=$request['name'];
            $item->initial_quantity=$request['initial_quantity'];
            $item->cat_id=$request['cat_id'];


            $item->save();

        }
        return $validator;
    }







}
