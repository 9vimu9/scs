<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\customer;
use Validator;

class CustomersController extends Controller
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
         $data=customer::OrderBy('created_at','desc')->get();

        return view('customers.index')->with("all_customers",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $customer=new customer();
      $val=  $this->AddUpdateCore($customer,$request);
      if ($val->fails()){
        return redirect()->back()->withErrors($val)->withInput();
      }
      else{
          return redirect('/customers/')->back()->with('success','successfully saved');
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
        $data=customer::find($id);
        return view("customers.edit")->with('customer',$data);
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
         $customer=customer::find($id);
         $val=  $this->AddUpdateCore($customer,$request);

         if ($val->fails()){
           return redirect()->back()->withErrors($val)->withInput();
         }
         else{
             return redirect('/customers/')->with('success','successfully updated');
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=customer::find($id);
       $customer->delete();
       return redirect('/customers')->with('success',"customer<strong> $customer->name </strong>removed successfully");

    }


    private function AddUpdateCore($customer,$request)
    {
        $validator = Validator::make($request->all(), [
          'name'=>'required',
          'nic'=>"required|regex:/^[0-9]{9}$/",
          'address'=>'required',
          'tel_1'=>"required|regex:/^[0-9]{10}$/",
          'tel_2'=>"required|regex:/^[0-9]{10}$/",
          'email'=>'email'
        ]);
        if (!$validator->fails()){
          $customer->name=$request['name'];
          $customer->nic=$request['nic'];
          $customer->address=$request['address'];
          $customer->tel=$request['tel_1']."_".$request['tel_2'];
          $customer->email=$request['email'];
          $customer->save();
        }
        return $validator;
    }
}
