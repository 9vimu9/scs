<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item_receives;
use App\receives;
use App\order;
use Illuminate\Support\Facades\DB;
use Validator;

class ItemreceivesController extends Controller
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
         $item_receive=new item_receives();
         $val= $this->AddUpdateCore($item_receive,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
       return redirect('/itemreceives/'.$item_receive->receive_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $receive=receives::find($id);
         $order=order::find($receive->order_id);
         $data=["order"=>$order];
        return view('itemreceives.index')->with($data);
       
        
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
        $item_receive=item_receives::find($id);
        $val= $this->AddUpdateCore($item_receive,$request);

        if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
            return redirect('/itemreceives/'.$item_receive->receive_id)->with('success',"updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item_receive=item_receives::find($id);
        $item_receive->delete();
        return redirect('/itemreceives/'.$item_receive->receive_id)->with('success',"item removed successfully");
    }


    private function AddUpdateCore($item_receive,$request)
    {

        $validator = Validator::make($request->all(), [
            'amount'=>'required|numeric',
            'rejected'=>'required|numeric',
            'receive_id'=>"required",
            'item_id' => 'required'
            
        ]);
        if (!$validator->fails()){
            $item_receive->amount=$request['amount'];
            $item_receive->rejected=$request['rejected'];
            $item_receive->receive_id=$request['receive_id'];
            $item_receive->item_id=$request['item_id'];

           
            if($request['precentage']=="on"){
                $item_receive->precentage=DB::table('meta')->latest()->value("discount");
               
            }
            else{
                
                $item_receive->precentage=0;
            }
            $item_receive->save();
 }
        return $validator;
      
    
    }
}
