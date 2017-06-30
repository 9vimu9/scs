<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\receives;
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
        $this->AddUpdateCore($receive,$request);
        
        //return redirect("/itemorders/".$order->id);
         return redirect("/receives/");

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
       
        //return redirect('/itemorders/'.$order->id);
         return redirect("/receives/");
    
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


    private function AddUpdateCore($receive,$request)
    {
        $this->validate($request,[
            'order_id'=>'required',
            'date'=>"required|date"
        ]);
        $receive->order_id=$request['order_id'];
        $receive->date=$request['date'];
       
        $receive->user_id=Auth::user()->id;
        
        $receive->save();

       

    }
}
