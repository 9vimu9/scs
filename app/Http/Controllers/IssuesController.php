<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\issues;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
class IssuesController extends Controller
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
        $data=issues::OrderBy('id','desc')->paginate(8);
        
        return view('issues.index')->with("issues",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $issue=new issues();
         $val= $this->AddUpdateCore($issue,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect("/issueitems/".$issue->id);
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
        $data=issues::find($id);
       
     
       return view("issues.edit")->with('issue',$data);
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
        $issue=issues::find($id);
        $val= $this->AddUpdateCore($issue,$request);
        if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
            return redirect("/issueitems/".$issue->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $issue=issues::find($id);
       $issue->delete();
       
        return redirect("/issues");
 
    }


    private function AddUpdateCore($issue,$request)
    {
       $validator = Validator::make($request->all(), [
            'officer_id'=>'required',
            'issue_date'=>"required|date",
            'description'=>'required'
            
        ]);
        if (!$validator->fails()){
            $issue->officer_id=$request['officer_id'];
            $issue->issue_date=$request['issue_date'];
            $issue->description=$request['description'];
            $issue->user_id=Auth::user()->id;
            
            $issue->save();
        }
        return $validator;
       

    }
}
