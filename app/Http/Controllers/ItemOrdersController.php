<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item_orders;
use App\order;

class ItemOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $item_order=new item_orders();
         $this->AddUpdateCore($item_order,$request);
        return redirect('/itemorders/'.$item_order->order_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $order=order::find($id);
        
        
        return view('itemorders.index')->with('order',$order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function AddUpdateCore($item_order,$request)
    {
         $this->validate($request,[
            'amount'=>'required',
            'unit_price'=>"required",
            'item_id'=>"required",
            
        ]);
        $item_order->amount=$request['amount'];
        $item_order->unit_price=$request['unit_price'];
        $item_order->item_id=$request['item_id'];
        $item_order->order_id=$request['order_id'];
      
             
        $item_order->save();

      
    
    }
}
