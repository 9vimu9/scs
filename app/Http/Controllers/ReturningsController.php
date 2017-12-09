<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\sales;
use App\returning;
use App\returning_item;
use App\sale_item;
use Auth;


class ReturningsController extends Controller
{


    public function __construct()
   {
       $this->middleware('auth');
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function change_actual_return_Date(Request $request)
    {
      $sale_id=$request->sale_id;
      $sale=sales::find($sale_id);
      $actual_return_date=$request['actual_return_date'];
      $sale->actual_return_date=$actual_return_date ;
      $sale->save();
      ItemTotalPriceUpdate($sale);
      $returnings=returning::where('sale_id',$sale_id)->get();

      if (count($returnings)==0 && $actual_return_date!='0000-00-00') {
        $returning=new returning();
        $returning->sale_id=$sale_id;
        $returning->date=$actual_return_date;
        $returning->user_id=Auth::user()->id;
        $returning->save();

        $sale_items=sale_item::where('sale_id',$sale_id)->get();
        foreach ($sale_items as $sale_item) {
          $returning_item=new returning_item();
          $returning_item->amount=$sale_item['amount'];
          $returning_item->sale_item_id=$sale_item['id'];
          $returning_item->returning_id=$returning->id;
          $returning_item->save();
          // $var="hi";
        }
        return redirect('/returningitems/'.$returning->id);

      }
      else {
        returning::where('sale_id',$sale_id)->delete();
        // $var="nhi";
        return redirect('/sales')->with('success',"sale no <strong> $sale->id </strong>updated successfully ");


      }




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
}
