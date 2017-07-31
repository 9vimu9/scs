<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\sales;
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
        $data=sales::OrderBy('id','desc')->paginate(8);

        return view('sales.index')->with("sales",$data);
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
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect("/saleitems/".$sale->id);
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

        return redirect("/sales");

    }


    private function AddUpdateCore($sale,$request)
    {
       $validator = Validator::make($request->all(), [
            'customer_id'=>'required',
            'sale_date'=>"required|date",
            'description'=>'required'

        ]);
        if (!$validator->fails()){
            $sale->customer_id=$request['customer_id'];
            $sale->sale_date=$request['sale_date'];
            $sale->description=$request['description'];
            $sale->user_id=Auth::user()->id;

            $sale->save();
        }
        return $validator;


    }
}
