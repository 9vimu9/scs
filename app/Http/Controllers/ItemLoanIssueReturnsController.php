<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item_loanissuereturn;
use App\loanissuereturns;
use App\loanissues;
use Illuminate\Support\Facades\DB;

class ItemLoanIssueReturnsController extends Controller
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
        
        $item_loanissuereturn=new item_loanissuereturn();
         $val= $this->AddUpdateCore($item_loanissuereturn,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
       return redirect('/itemloanissuereturns/'.$item_loanissuereturn->loanissuereturn_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $loanissuereturn=loanissuereturns::find($id);
         $loanissue=loanissues::find($loanissuereturn->loanissue_id);
         $data=["loanissue"=>$loanissue];
        return view('itemloanissuereturns.index')->with($data);
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
        $item_loanissuereturn=item_loanissuereturn::find($id);
        $val= $this->AddUpdateCore($item_loanissuereturn,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
         return redirect('/itemloanissuereturns/'.$item_loanissuereturn->loanissuereturn_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $item_loanissuereturn=item_loanissuereturn::find($id);
        $item_loanissuereturn->delete();
        return redirect('/itemloanissuereturns/'.$item_loanissuereturn->loanissuereturn_id);
    }

    private function AddUpdateCore($item_loanissuereturn,$request)
    {
        $validator = Validator::make($request->all(), [
      
            'amount'=>'required|numeric',
            'rejected'=>'required|numeric',
            'loanissuereturn_id'=>"required",
            'item_id'=>"required"
            
        ]);
        if (!$validator->fails()){
        $item_loanissuereturn->amount=$request['amount'];
        $item_loanissuereturn->rejected=$request['rejected'];
        $item_loanissuereturn->loanissuereturn_id=$request['loanissuereturn_id'];
         $item_loanissuereturn->item_id=$request['item_id'];
      
             
        $item_loanissuereturn->save();
  }
        return $validator;
      
    
    }
}
