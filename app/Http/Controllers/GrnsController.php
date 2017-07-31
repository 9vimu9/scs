<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\grns;

use Auth;
use Illuminate\Support\Facades\DB;

class grnsController extends Controller
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
         $data=grns::OrderBy('id','desc')->paginate(8);

        return view('grns.index')->with("grns",$data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('grns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grn=new grns();
         $this->AddUpdateCore($grn,$request);

        return redirect('/itemgrns/'.$grn->id);


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
        $data=grns::find($id);

       return view("grns.edit")->with('grn',$data);
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
        $grn=grns::find($id);
        $this->AddUpdateCore($grn,$request);

        return redirect('/itemgrns/'.$grn->id);
        // return redirect("/grns/");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grn=grns::find($id);
        $grn->delete();
        return redirect('/grns/')->with('success',"GRN no <strong> $grn->id </strong>removed successfully");
    }


    private function AddUpdateCore($grn,$request)
    {
        if($grn->order_id==$request['order_id'])
            $order_id_validation="required";
        else
            $order_id_validation="required|unique:grns";

        $this->validate($request,[
            'order_id'=>$order_id_validation,
            'date'=>"required|date",
            'discount'=>"numeric"
        ]);

      

        $grn->discount=$request['discount'];
        $grn->order_id=$request['order_id'];
        $grn->date=$request['date'];

        $grn->user_id=Auth::user()->id;

        $grn->save();



    }
}
