<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\officer;
use Validator;

class OfficersController extends Controller
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
         $data=officer::OrderBy('created_at','desc')->paginate(8);
        
        return view('officers.index')->with("all_officers",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("officers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $officer=new officer();
        $this->validate($request,[
            'name'=>'required',
            'nic'=>"required|regex:/^[0-9]{9}$/"
        ]);
        $officer->name=$request['name'];
        $officer->nic=$request['nic'];
               
        $officer->save();

        return redirect('/officers/')->with('success','officer added successfully');
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
        $data=officer::find($id);
        return view("officers.edit")->with('officer',$data);
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
         $officer=officer::find($id);
      
        $this->validate($request,[
            'name'=>'required',
            'nic'=>"required|regex:/^[0-9]{9}$/"
        ]);
        $officer->name=$request['name'];
        $officer->nic=$request['nic'];
               
        $officer->save();

         return redirect('/officers')->with('success','officer updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $officer=officer::find($id);
       $officer->delete();
       return redirect('/officers')->with('success',"officer<strong> $officer->name </strong>removed successfully");
 
    }
}
