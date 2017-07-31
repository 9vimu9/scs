<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\hut_items;
use App\huts;
use Validator;
use Illuminate\Validation\Rule;

class HutItemsController  extends Controller
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
    public function create($hut_id)
    {

      $hut=huts::find($hut_id);
      return view("hutitems.create")->with('hut',$hut);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $hut_item=new hut_items();
      $this->AddUpdateCore($hut_item,$request);
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hut=huts::find($id);
        return view('hutitems.index')->with('hut',$hut);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data=hut_items::find($id);
      return view("hutitems.edit")->with('hut_item',$data);
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
         $hut_item=hut_items::find($id);
         $this->AddUpdateCore($hut_item,$request);
         return redirect('/hutitems/'.$hut_item->hut_id);

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $hut_item=hut_items::find($id);
      $hut_item->delete();
      return redirect('/hutitems/'.$hut_item->hut_id)->with('success',"item removed successfully");

    }

    private function AddUpdateCore($hut_item,$request)
    {
      $item_id_validation;
      if( $hut_item->id!=null){//0 wata wadaa wadi kiyanne update ekak
        $item_id_validation='required|unique_with:hut_items,hut_id,'.$hut_item->id;
      }
      else{
        $item_id_validation='required|unique_with:hut_items,hut_id';
      }

      $this->validate($request,[
        'amount'=>'required|numeric',
        'item_id' => $item_id_validation
      ]);

      $hut_item->amount=$request['amount'];

      $hut_item->item_id=$request['item_id'];
      $hut_item->hut_id=$request['hut_id'];

      $hut_item->save();

    }











    }
