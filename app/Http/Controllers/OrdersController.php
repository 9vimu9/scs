<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use Auth;
use Illuminate\Support\Facades\DB;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Order::OrderBy('id','desc')->paginate(8);
        
        return view('orders.index')->with("orders",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order=new Order();
        $this->AddUpdateCore($order,$request);
        
        return redirect("/itemorders/".$order->id);
  
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data=Order::find($id);
        $results =  DB::table("suppliers")->find($data->supplier_id);
        $data['supplier_name']= $results->name;
     
       return view("orders.edit")->with('order',$data);
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
        $order=Order::find($id);
        $this->AddUpdateCore($order,$request);
       
        return redirect('/itemorders/'.$order->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=order::find($id);
       $order->delete();
       return redirect('/orders/create')->with('success',"order no <strong> $order->id </strong>removed successfully");
    }

    private function AddUpdateCore($order,$request)
    {
        $this->validate($request,[
            'supplier_id'=>'required',
            'date'=>"required|date|before:deadline",
            'deadline'=>"required|date|after:date"
        ]);
        $order->supplier_id=$request['supplier_id'];
        $order->date=$request['date'];
        $order->deadline=$request['deadline'];
        $order->user_id=Auth::user()->id;
        
        $order->save();

       

    }
}
