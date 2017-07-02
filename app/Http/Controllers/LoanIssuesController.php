<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\loanissues;
use Auth;
use Illuminate\Support\Facades\DB;

class LoanIssuesController extends Controller
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
         return view('loanissues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loanissue=new loanissues();
        $this->AddUpdateCore($loanissue,$request);
       // return redirect("/loanissues/".$loanissues->id);
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


    private function AddUpdateCore($loanissue,$request)
    {
        $this->validate($request,[
            'officer_id'=>'required',
            'issue_date'=>"required|date",
            'description'=>'required'
            
        ]);
        $loanissue->officer_id=$request['officer_id'];
        $loanissue->issue_date=$request['issue_date'];
        $loanissue->description=$request['description'];
        $loanissue->user_id=Auth::user()->id;
        
        $loanissue->save();

       

    }
}
