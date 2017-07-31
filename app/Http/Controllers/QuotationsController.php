<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\quotation;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
class QuotationsController extends Controller
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
        $data=quotation::OrderBy('created_at','desc')->get();

        return view('quotations.index')->with("quotations",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quotation=new quotation();
        $val=  $this->AddUpdateCore($quotation,$request);

        if($val->fails())
          return redirect()->back()->withErrors($val)->withInput();
        else
          return redirect("/quotationitems/".$quotation->id);

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
      $data=quotation::find($id);
      return view("quotations.edit")->with('quotation',$data);
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
        $quotation=quotation::find($id);
        $this->AddUpdateCore($quotation,$request);
        $val=  $this->AddUpdateCore($quotation,$request);

        if ($val->fails())
          return redirect()->back()->withErrors($val)->withInput();
        else
          return redirect('/quotationitems/'.$quotation->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $quotation=quotation::find($id);
       $quotation->delete();
       return redirect('/quotations')->with('success',"quotation no <strong> $quotation->id </strong>removed successfully");
    }

    private function AddUpdateCore($quotation,$request)
    {
      $validator = Validator::make($request->all(), [
            'customer_id'=>'required',
            'service_charge'=>'numeric',
            'advance'=>'numeric',
            'discount'=>'numeric'

        ]);

        if (!$validator->fails()){
          $quotation->days=$request['days'];
          $quotation->customer_id=$request['customer_id'];
          $quotation->service_charge=$request['service_charge'];
          $quotation->advance=$request['advance'];
          $quotation->discount=$request['discount'];
          $quotation->user_id=Auth::user()->id;
          $quotation->sales_type=$request['checkfuneral']=="on" ? 1:0;
          // NOTE: sales_type ==1 means funeral 0 means any other occasion
          $quotation->save();
        }

        return $validator;
    }
}
