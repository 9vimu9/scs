<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\sales;
use App\quotation_item;
use App\sale_item;
use Auth;
use Validator;
class SalesController extends Controller
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
        // $data=sales::OrderBy('id','desc')->paginate(6);
        $sales=sales::all();
        $title="SALES";
        $data=['sales'=>$sales,'title'=>$title];

        return view('sales.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $sale=new sales();
      $val= $this->AddUpdateCore($sale,$request);

      if ($val->fails()){
        return redirect()->back()->withErrors($val)->withInput();
      }
      else{
        $quotation_items=quotation_item::where('quotation_id',$sale->quotation_id)->get();
        foreach ($quotation_items as $quotation_item) {
          $sale_item=new sale_item();
          $sale_item->amount=$quotation_item['amount'];
          $sale_item->unit_price=$quotation_item->unit_price;
          $sale_item->sale_id=$sale->id;
          $sale_item->item_id=$quotation_item['item_id'];
          $sale_item->user_id=Auth::user()->id;
          $sale_item->total=$quotation_item->total;
          $sale_item->save();
          ItemTotalPriceUpdate($sale);
        }

        return redirect("/saleitems/".$sale->id);

      }
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
      $data=sales::find($id);
      return view("sales.edit")->with('sale',$data);
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
        $sale=sales::find($id);
        $val= $this->AddUpdateCore($sale,$request);
        if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
            return redirect("/saleitems/".$sale->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $sale=sales::find($id);
         $sale->delete();
         return redirect('/sales')->with('success',"sale no <strong> $sale->id </strong>removed successfully");
    }


    private function AddUpdateCore($sale,$request){

      $validator = Validator::make($request->all(), [
            'quotation_id'=>"required|numeric",
            'deliver_date'=>"required|date|before:return_date",
            'return_date'=>"required|date|after:deliver_date",
            'service_charge'=>'numeric',
            'advance'=>'required|numeric',
            'discount'=>'numeric'

        ]);

        $days=$request['days'];


        // if ($sale!=null && $sale->days!=$days ){
        //   $this->ItemTotalPriceUpdateByDays($sale,$days);
        // }

        if (!$validator->fails()){

          $sale->deliver_date=$request['deliver_date'];
          $sale->return_date=$request['return_date'];
          $sale->service_charge=$request['service_charge'];
          $sale->advance=$request['advance'];
          $sale->discount=$request['discount'];
          $sale->user_id=Auth::user()->id;
          $sale->quotation_id=$request['quotation_id'];

          $sale->save();
          ItemTotalPriceUpdate($sale);
        }
      return $validator;
    }
}
