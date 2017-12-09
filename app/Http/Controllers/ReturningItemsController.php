<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\returning;
use App\returning_item;
use Illuminate\Support\Facades\DB;



class ReturningItemsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($returning_id)
    {
      // return $returning_id;
      $returning=returning::find($returning_id);
      $returning_items=returning_item::where('returning_id',$returning_id)->get();
      $delever_date = strtotime($returning->sale->deliver_date );
      $actual_return_date=$returning->sale->actual_return_date=='0000-00-00' ? $returning->sale->return_date : $returning->sale->actual_return_date;
      $actual_return_date = strtotime($actual_return_date);
      $days = ($actual_return_date - $delever_date)/86400;// == return sec in difference
      $returning['days']=$days;

      $data=['returning'=>$returning,'returning_items'=>$returning_items];
      return view("returningitems.index",$data);
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
      $returning_item_ids=$request->returning_item_id;
      $returning_item_amounts=$request->amount;

      for ($i=0; $i <count($returning_item_ids) ; $i++) {
        DB::table('returning_items')->where('id',$returning_item_ids[$i])->update(['amount' => $returning_item_amounts[$i]]);
      }
      return redirect('/returningitems/'.$id);
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
}
