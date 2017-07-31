<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\huts;
use App\item;
use Validator;
use App\change_prices;
use Auth;

use Illuminate\Support\Facades\DB;

class HutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data=huts::OrderBy('created_at','desc')->get();

      return view('huts.index')->with("huts",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
       $this->middleware('auth');
     }

    public function create()
    {
        return view('huts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $hut=new huts();
      $val=  $this->AddUpdateCore($hut,$request);
      if ($val->fails()){
        return redirect()->back()->withErrors($val)->withInput();
      }
      else{
        return redirect('/hutitems/'.$hut->id)->with('success','successfully saved');
      }
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
      $data=huts::find($id);
      return view("huts.edit")->with('hut',$data);

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
      $hut=huts::find($id);
      $val=  $this->AddUpdateCore($hut,$request);
      if ($val->fails())
          return redirect()->back()->withErrors($val)->withInput();
      else
      return redirect('/hutitems/'.$hut->id)->with('success','successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $hut=huts::find($id);
      $hut->delete();

      $item=item::find($hut->item_id);
      $item->delete();
      return redirect('/huts')->with('success',"Hut<strong> $item->name </strong>removed successfully");

    }


    private function AddUpdateCore($hut,$request)
    {


        $validator = Validator::make($request->all(), [
            'name'=>"required",
            'cat_id'=>"required|numeric",
            'price'=>"numeric"
        ]);

        if (!$validator->fails()){

            //check AddUpdateCore use for add or update
            //because at update we shouldn't create new item

            $last_price=-1;

            if ($hut->id!=null) {
              $item=item::find($hut->item_id);
              $last_price=change_prices::where('item_id', $hut->item_id)->latest()->first()->price;
            }
            else {
              $item=new item();

            }

            $item->name=$request['name'];
            $item->cat_id=$request['cat_id'];
            $item->save();

            if ($hut->id==null){
              $hut->item_id=$item->id;
              $hut->save();
              // NOTE: so when in items table if ishut>0 means
              //ishut equal to hut_id
              $item->ishut=$hut->id;
              $item->save();
            }
            if ($request['price']!=$last_price) {
              $new_price=new change_prices();
              $new_price->item_id= $item->id;
              $new_price->price=$request['price'];
              $new_price->user_id= Auth::user()->id;
              $new_price->save();
            }

        }

      //  die("rrrrr".change_prices::find($hut->item_id)->latest()->first());
        return $validator;
    }


}
