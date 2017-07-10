<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item_loanissue;
use App\loanissues;

use Validator;
class ItemLoanIssuesController extends Controller
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
    public function create($loanissue_id)
    {
          return view("itemloanissues.create")->with('loanissue_id',$loanissue_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $item_loanissue=new item_loanissue();
         $val= $this->AddUpdateCore($item_loanissue,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
       return redirect('/itemloanissues/'.$item_loanissue->loanissue_id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $loanissue=loanissues::find($id);
        return view('itemloanissues.index')->with('loanissue',$loanissue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $item_loanissue=item_loanissue::find($id);
        
        return view("itemloanissues.edit")->with('item_loanissue',$item_loanissue);
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
        $item_loanissue=item_loanissue::find($id);
        
        $val= $this->AddUpdateCore($item_loanissue,$request);
             if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect('/itemloanissues/'.$item_loanissue->loanissue_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item_loanissue=item_loanissue::find($id);
       $item_loanissue->delete();
       return redirect('/itemloanissues/'.$item_loanissue->loanissue_id);
    }

     private function AddUpdateCore($item_loanissue,$request)
    {
         $validator = Validator::make($request->all(), [
            'amount'=>'required|numeric',
            'item_id'=>"required|numeric",
            'loanissue_id'=>"required|numeric",
            'return_date'=>"required|date"
        ]);
if (!$validator->fails()){
        $item_loanissue->amount=$request['amount'];
        $item_loanissue->loanissue_id=$request['loanissue_id'];
        $item_loanissue->item_id=$request['item_id'];
        $item_loanissue->return_date=$request['return_date'];
           
        $item_loanissue->save();
 }
        return $validator;
      
    
    }
}
