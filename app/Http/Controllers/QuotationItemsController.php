<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\quotation_item;
use App\quotation;
use Illuminate\Support\Facades\DB;
use Validator;

class QuotationItemsController extends Controller
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
    public function create($quotation_id)
    {
        $quotation=quotation::find($quotation_id);
        return view("quotationitems.create")->with('quotation',$quotation);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quotation_item=new quotation_item();
        $this->AddUpdateCore($quotation_item,$request);
        return redirect('/quotationitems/'.$quotation_item->quotation_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quotation=quotation::find($id);
        return view('quotationitems.index')->with('quotation',$quotation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=quotation_item::find($id);
        return view("quotationitems.edit")->with('quotation_item',$data);
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
        $quotation_item=quotation_item::find($id);
        $this->AddUpdateCore($quotation_item,$request);
        return redirect('/quotationitems/'.$quotation_item->quotation_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $quotation_item=quotation_item::find($id);
      $quotation_item->delete();
      return redirect('/quotationitems/'.$quotation_item->quotation_id);

    }

    private function AddUpdateCore($quotation_item,$request)
    {
        $item_id_validation;
        if( $quotation_item->id>0)//0 wata wadaa wadi kiyanne update ekak
        {
            $item_id_validation='required|unique_with:quotation_items,quotation_id,'. $quotation_item->id;
        }
        else
        {
             $item_id_validation='required|unique_with:quotation_items,quotation_id';
        }
         $this->validate($request,[
            'amount'=>'required|numeric',
            'item_id' => $item_id_validation,
            'quotation_id'=>"required|numeric"
        ]);
            $quotation_item->amount=$request['amount'];
            $quotation_item->quotation_id=$request['quotation_id'];
            $quotation_item->item_id=$request['item_id'];
            $quotation_item->save();

    }
}
