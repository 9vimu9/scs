<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\sale_item;
use App\sales;
use Illuminate\Support\Facades\DB;
use Validator;

class SaleItemsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sale_id)
    {
          return view("saleitems.create")->with('sale_id',$sale_id);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale_item=new sale_item();
       $this->AddUpdateCore($sale_item,$request);

            return redirect('/saleitems/'.$sale_item->sale_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale=sales::find($id);
        return view('saleitems.index')->with('sale',$sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=sale_item::find($id);

        return view("saleitems.edit")->with('sale_item',$data);
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
        $sale_item=sale_item::find($id);
        $this->AddUpdateCore($sale_item,$request);


        return redirect('/saleitems/'.$sale_item->sale_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $sale_item=sale_item::find($id);
       $sale_item->delete();
      return redirect('/saleitems/'.$sale_item->sale_id);

    }

    private function AddUpdateCore($sale_item,$request)
    {
        $item_id_validation;
        if( $sale_item->id>0)//0 wata wadaa wadi kiyanne update ekak
        {
            $item_id_validation='required|unique_with:sale_items,sale_id,'. $sale_item->id;

        }
        else
        {
             $item_id_validation='required|unique_with:sale_items,sale_id';
        }
         $this->validate($request,[
            'amount'=>'required|numeric',
            'item_id' => $item_id_validation,
            'sale_id'=>"required|numeric"
        ]);

            $sale_item->amount=$request['amount'];
            $sale_item->sale_id=$request['sale_id'];
            $sale_item->item_id=$request['item_id'];

            $sale_item->save();




    }
}
