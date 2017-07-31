<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Supplier;
use Validator;

class SuppliersController extends Controller
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

        $data=Supplier::OrderBy('name','desc')->paginate(8);

        return view('suppliers.index')->with("all_suppliers",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("suppliers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier=new Supplier();
        $val=  $this->AddUpdateCore($supplier,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
          return redirect('/suppliers/')->with('success','successfully saved');
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
        $data=Supplier::find($id);
        return view("suppliers.edit")->with('supplier',$data);
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
        $supplier=Supplier::find($id);

        $val=  $this->AddUpdateCore($supplier,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
         return redirect('/suppliers')->with('success','supplier <strong>'.$supplier->name.'</strong> updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $supplier=Supplier::find($id);
       $supplier->delete();
       return redirect('/suppliers')->with('success',"supplier<strong> $supplier->name </strong>removed successfully");
    }

    private function AddUpdateCore($supplier,$request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'tel'=>"required|regex:/^[0-9]{10}$/",


        ]);
        if (!$validator->fails()){
            $supplier->name=$request['name'];
            $supplier->address=$request['address'];
            $supplier->tel=$request['tel'];
            $supplier->save();
        }

        return $validator;

        # code...
    }
}
