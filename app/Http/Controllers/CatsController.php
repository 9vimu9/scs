<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\cat;
use Validator;

class CatsController extends Controller
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
        $data=cat::OrderBy('name','desc')->paginate(8);

        return view('cats.index')->with("cats",$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view("cats.create");//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat=new cat();
        $val=  $this->AddUpdateCore($cat,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
          return redirect('/cats/')->with('success','successfully saved');
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
        $data=cat::find($id);
        return view("cats.edit")->with('cat',$data);
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
         $cat=cat::find($id);

        $val=  $this->AddUpdateCore($cat,$request);
              if ($val->fails())
            return redirect()->back()->withErrors($val)->withInput();
        else
         return redirect('/cats')->with('success','cat <strong>'.$cat->name.'</strong> updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cat=cat::find($id);
      $cat->delete();
      return redirect('/cats')->with('success','cat <strong>'.$cat->name.'</strong> updated');

    }


     private function AddUpdateCore($cat,$request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required'
        ]);
         if (!$validator->fails()){
        $cat->name=$request['name'];



        $cat->save();
 }
        return $validator;

        # code...
    }
}
