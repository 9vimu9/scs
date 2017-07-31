<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\item_grns;
use App\grns;
use App\order;
use Illuminate\Support\Facades\DB;
use Validator;

class ItemGrnsController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //      $item_grn=new item_grns();
    //      $val= $this->AddUpdateCore($item_grn,$request);
    //          if ($val->fails())
    //         return redirect()->back()->withErrors($val)->withInput();
    //     else
    //    return redirect('/itemgrns/'.$item_grn->grn_id);
    // }
    public function add(Request $request)
    {
      $item_grn=new item_grns();
      $val= $this->AddUpdateCore($item_grn,$request);
      if ($val->fails()){
        return \Response::json(array(
                'errors' => $val->getMessageBag()->toArray()
        ) );
      }
      else{
        return response ()->json ( $item_grn );
      }
    }

//     public function store(Request $request) {
//
//     if ($validator->fails ())
//         return Response::json ( array (
//
//                 'errors' => $validator->getMessageBag ()->toArray ()
//         ) );
//         else {
//             $data = new Data ();
//             $data->name = $request->name;
//             $data->save ();
//             return response ()->json ( $data );
//         }
// }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $grn=grns::find($id);
         $order=order::find($grn->order_id);
         $data=["order"=>$order];
        return view('itemgrns.index')->with($data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $item_grn=item_grns::find($id);
    //     $val= $this->AddUpdateCore($item_grn,$request);
    //
    //     if ($val->fails())
    //         return redirect()->back()->withErrors($val)->withInput();
    //     else
    //         return redirect('/itemgrns/'.$item_grn->grn_id)->with('success',"updated successfully");
    // }

    public function update(Request $request)
    {
        $item_grn=item_grns::find($request->id);
        $val= $this->AddUpdateCore($item_grn,$request);
        return response ()->json ( $item_grn );

    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(Request $request)
    {
        $item_grn=item_grns::find($request->id);
        $item_grn->delete();
        return response ()->json ();
    }

    private function AddUpdateCore($item_grn,$request)
    {

        $validator = Validator::make($request->all(), [
            'amount'=>'required|numeric',
            'grn_id'=>"required",
            'item_id' => 'required'

        ]);
        if (!$validator->fails()){
            $item_grn->amount=$request['amount'];

            $item_grn->grn_id=$request['grn_id'];
            $item_grn->item_id=$request['item_id'];
            $item_grn->save();
 }
        return $validator;


    }
}
