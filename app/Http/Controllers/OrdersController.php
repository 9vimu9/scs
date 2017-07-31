<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\order;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
class OrdersController extends Controller
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
        $data=order::OrderBy('created_at','desc')->get();

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
        $order=new order();
        $val=  $this->AddUpdateCore($order,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
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
         $data=order::find($id);


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
        $order=order::find($id);
        $this->AddUpdateCore($order,$request);
        $val=  $this->AddUpdateCore($order,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
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
       return redirect('/orders')->with('success',"order no <strong> $order->id </strong>removed successfully");
    }

    private function AddUpdateCore($order,$request)
    {

 $validator = Validator::make($request->all(), [
            'supplier_id'=>'required',
            'date'=>"required|date|before:deadline",
            'deadline'=>"required|date|after:date"
        ]);
         if (!$validator->fails()){

        $order->supplier_id=$request['supplier_id'];
        $order->date=$request['date'];
        $order->deadline=$request['deadline'];
        $order->user_id=Auth::user()->id;

        $order->save();
  }
        return $validator;


    }
}
