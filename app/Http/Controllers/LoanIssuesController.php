<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\loanissues;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class LoanIssuesController extends Controller
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
        $data=loanissues::OrderBy('id','desc')->paginate(8);
        
        return view('loanissues.index')->with("loanissues",$data);
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
        $val=  $this->AddUpdateCore($loanissue,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect("/itemloanissues/".$loanissue->id);
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
         $data=loanissues::find($id);
       
     
       return view("loanissues.edit")->with('loanissue',$data);
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
        $loanissue=loanissues::find($id);
        $val=  $this->AddUpdateCore($loanissue,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
       
      return redirect("/itemloanissues/".$loanissue->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $loanissue=loanissues::find($id);
       $loanissue->delete();
       
        return redirect("/loanissues");
    }


    private function AddUpdateCore($loanissue,$request)
    {
         $validator = Validator::make($request->all(), [
            'officer_id'=>'required',
            'issue_date'=>"required|date",
            'description'=>'required'
            
        ]);
        if (!$validator->fails()){
        $loanissue->officer_id=$request['officer_id'];
        $loanissue->issue_date=$request['issue_date'];
        $loanissue->description=$request['description'];
        $loanissue->user_id=Auth::user()->id;
        
        $loanissue->save();
      }
        return $validator;
       

    }
}
