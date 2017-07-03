<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\issue_item;
use App\issues;
use Illuminate\Support\Facades\DB;

class IssueItemsController extends Controller
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
    public function create($issue_id)
    {
          return view("issueitems.create")->with('issue_id',$issue_id);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $issue_item=new issue_item();
         $val= $this->AddUpdateCore($issue_item,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
       return redirect('/issueitems/'.$issue_item->issue_id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issue=issues::find($id);
        return view('issueitems.index')->with('issue',$issue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=issue_item::find($id);
        
        return view("issueitems.edit")->with('issue_item',$data);
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
        $issue_item=issue_item::find($id);
        $val= $this->AddUpdateCore($issue_item,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
       
        return redirect('/issueitems/'.$issue_item->issue_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $issue_item=issue_item::find($id);
       $issue_item->delete();
      return redirect('/issueitems/'.$issue_item->issue_id);

    }

    private function AddUpdateCore($issue_item,$request)
    {
         $validator = Validator::make($request->all(), [
            'amount'=>'required|numeric',
            'item_id'=>"required|numeric",
            'issue_id'=>"required|numeric"
        ]);
        if (!$validator->fails()){
            $issue_item->amount=$request['amount'];
            $issue_item->issue_id=$request['issue_id'];
            $issue_item->item_id=$request['item_id'];
            
            $issue_item->save();
        }
        return $validator;
      
    
    }
}
