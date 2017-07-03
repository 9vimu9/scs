<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\receives;
use App\Order;
use Auth;
use Illuminate\Support\Facades\DB;

class ReceivesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data=receives::OrderBy('id','desc')->paginate(8);
       
        return view('receives.index')->with("receives",$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('receives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receive=new receives();
         $val= $this->AddUpdateCore($receive,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect('/itemreceives/'.$receive->id);
        // return redirect("/receives/");

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
        $data=receives::find($id);
                   
       return view("receives.edit")->with('receive',$data);
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
        $receive=receives::find($id);
        $this->AddUpdateCore($receive,$request);
       $val= $this->AddUpdateCore($receive,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect('/itemreceives/'.$receive->id);
        // return redirect("/receives/");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receive=receives::find($id);
        $receive->delete();
        return redirect('/receives/')->with('success',"GRN no <strong> $receive->id </strong>removed successfully");
    }


    private function AddUpdateCore($receive,$request)
    {
        if($receive->order_id==$request['order_id'])
            $order_id_validation="required";
        else
            $order_id_validation="required|unique:receives";

        $validator = Validator::make($request->all(), [
            'order_id'=>$order_id_validation,
            'date'=>"required|date"
        ]);
         if (!$validator->fails()){
        $receive->order_id=$request['order_id'];
        $receive->date=$request['date'];
       
        $receive->user_id=Auth::user()->id;
        
        $receive->save();

        }
        return $validator;

    }
}
