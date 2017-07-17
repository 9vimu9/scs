<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item;
use App\cat;
use App\item_orders;
use App\item_receives;
use App\issue_item;
use App\item_loanissue;
use App\item_loanissuereturn;
use Illuminate\Support\Facades\DB;

use Validator;


class ItemsController extends Controller
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
        $data=item::OrderBy('name','desc')->get();

        return view('items.index')->with("all_items",$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("items.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item=new item();
        $val=  $this->AddUpdateCore($item,$request);
        if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
            return redirect('/items/')->with('success','successfully saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data_o = item_orders::select(DB::raw('"1o" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,order_id as id,amount,created_at'))
                    ->where('item_id', '=', $id);

                   //  DATE_FORMAT(created_at, "%Y/%l/%d")

        $data_r = item_receives::select(DB::raw('"2r" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,receive_id as id,(amount-rejected)as amount,created_at'))
                    ->where('item_id', '=', $id);

        $data_li = item_loanissue::select(DB::raw('"4li" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,loanissue_id as id,amount,created_at'))
                    ->where('item_id', '=', $id);

        $data_lir = item_loanissuereturn::select(DB::raw('"3lir" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,loanissuereturn_id as id,(amount-rejected)as amount,created_at'))
                    ->where('item_id', '=', $id);


        $logs = issue_item::select(DB::raw('"5i" as type,DATE_FORMAT(created_at, "%Y/%m/%d") as date,issue_id as id,(amount)as amount,created_at'))
                    ->where('item_id', '=', $id)
                    ->union($data_r)
                    ->union($data_o)
                    ->union($data_li)
                    ->union($data_lir)
                    ->orderBy('created_at')
                    ->orderBy('type')
                    ->get();

//return $logs;

        return view("items.log")->with(['logs'=>$logs,'item'=>item::find($id)]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data=item::find($id);
        return view("items.edit")->with('item',$data);
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
        $item=item::find($id);
        $val=  $this->AddUpdateCore($item,$request);
        if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
        return redirect('/items/')->with('success','successfully updated');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item=item::find($id);
       $item->delete();
       return redirect('/items')->with('success',"item<strong> $item->name </strong>removed successfully");

    }
    private function AddUpdateCore($item,$request)
    {//'email' => 'required|unique:users,email,' . $user->id

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'code'=>"required",
            'location'=>"required",
            'max'=>"required|numeric",
            'min'=>"required|numeric",
            'reorder'=>"required|numeric",
            'cat_id'=>"required|numeric",
        ]);
        if (!$validator->fails()){

            $item->name=$request['name'];
            $item->code=$request['code'];
            $item->location=$request['location'];
            $item->max=$request['max'];
            $item->min=$request['min'];
            $item->reorder=$request['reorder'];
            $item->cat_id=$request['cat_id'];

            $item->save();
            session(['cat_name' => cat::find($request['cat_id'])->name,'cat_id' => $request['cat_id'],'cat_symbol' =>cat::find($request['cat_id'])->symbol]);

        }
        return $validator;
    }



    public function LedgerShow($id)
    {

    }




}
