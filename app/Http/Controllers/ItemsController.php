<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Item;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Item::OrderBy('name','desc')->paginate(8);
        
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
        $item=new Item();
         $this->AddUpdateCore($item,$request);
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
         $data=Item::find($id);
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
        $item=Item::find($id);
        $this->AddUpdateCore($item,$request);
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
        $item=Item::find($id);
       $item->delete();
       return redirect('/items')->with('success',"item<strong> $item->name </strong>removed successfully");
  
    }
    private function AddUpdateCore($item,$request)
    {
         $this->validate($request,[
            'name'=>'required',
            'code'=>"required",
            'location'=>"required",
            'max'=>"required|numeric",
            'min'=>"required|numeric",
            'reorder'=>"required|numeric",
            'cat'=>"required|numeric",
        ]);
        $item->name=$request['name'];
        $item->code=$request['code'];
        $item->location=$request['location'];
        $item->max=$request['max'];
        $item->min=$request['min'];
        $item->reorder=$request['reorder'];
        $item->cat=$request['cat'];
             
        $item->save();

      
    
    }

     public function CheckReorder(Request $request)
    {
        
        $id = trim($request->q);
        

        if (empty($id)) {
            return \Response::json([]);
        }

       
         $item=Item::find($id);
          return response()->json( $item->reorder);
    }
}
