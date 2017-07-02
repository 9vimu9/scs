<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\loanissuereturns;
use App\loanissues;
use Auth;
use Illuminate\Support\Facades\DB;

class LoanIssueReturnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data=loanissuereturns::OrderBy('id','desc')->paginate(8);
       
        return view('loanissuereturns.index')->with("loanissuereturns",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('loanissuereturns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loanissuereturn=new loanissuereturns();
        $this->AddUpdateCore($loanissuereturn,$request);
        
        return redirect('/loanissuereturns');
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
        $data=loanissuereturns::find($id);
                   
       return view("loanissuereturns.edit")->with('loanissuereturn',$data);
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
         $loanissuereturn=loanissuereturns::find($id);
        $this->AddUpdateCore($loanissuereturn,$request);
       
       // return redirect('/itemreceives/'.$receive->id);
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

    private function AddUpdateCore($loanissuereturn,$request)
    {
        if($loanissuereturn->loanissue_id==$request['loanissue_id'])
            $loanissue_id_validation="required";
        else
            $loanissue_id_validation="required|unique:loanissuereturns";

        $this->validate($request,[
            'loanissue_id'=>$loanissue_id_validation,
            'date'=>"required|date"
        ]);
        $loanissuereturn->loanissue_id=$request['loanissue_id'];
        $loanissuereturn->date=$request['date'];
       
        $loanissuereturn->user_id=Auth::user()->id;
        
        $loanissuereturn->save();

       

    }
}
