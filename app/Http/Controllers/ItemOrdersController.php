<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item_orders;
use App\order;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Validation\Rule;

class ItemOrdersController extends Controller
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
    public function create($order_id)
    {
      //  echo($order_id);
         return view("itemorders.create")->with('order_id',$order_id);
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
        $data=item_orders::find($id);
        // $results =  DB::table("items")->find($data->item_id);
        // $data['item_name']= $results->name;
        // $data['item_reorder']= $results->reorder;

       
     //echo($data);
         
       return view("itemorders.edit")->with('item_order',$data);
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
         $item_order=item_orders::find($id);
         $this->AddUpdateCore($item_order,$request);
            
       return redirect('/itemorders/'.$item_order->order_id);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item_order=item_orders::find($id);
       $item_order->delete();
       return redirect('/itemorders/'.$item_order->order_id)->with('success',"item removed successfully");
  
    }

    private function AddUpdateCore($item_order,$request)
    {
        


        $item_id_validation;
        if( $item_order->id!=null)//0 wata wadaa wadi kiyanne update ekak
        {
           
            $item_id_validation='required|unique_with:item_orders,order_id,'.$item_order->id;
           
        }
        else
        {
            
             $item_id_validation='required|unique_with:item_orders,order_id';
        }
 echo($request['order_id']."gfsgssd");
         $this->validate($request,[
            'amount'=>'required|numeric',
            'unit_price'=>"required|numeric",
            'item_id' => $item_id_validation,
           //  'order_id'=>"required|numeric"
           
        ]);
      
            $item_order->amount=$request['amount'];
            $item_order->unit_price=$request['unit_price'];
            $item_order->item_id=$request['item_id'];
            $item_order->order_id=$request['order_id'];
            
            $item_order->save();
        
      
      
    
    }











    }

