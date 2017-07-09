<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use App\Http\Requests;
use App\items_reportrequest;
use App\reportrequest;
use Illuminate\Support\Facades\DB;
use Validator;

class ItemsReportrequestController extends Controller
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
    public function store(Request $request)
    {       
        $items_reportrequest=new items_reportrequest();
       
        $validator = Validator::make($request->all(), [
            'amount'=>'required|numeric',
            'amount_in_store'=>"required|numeric",
            'item_id'=>'required|unique_with:items_reportrequests,reportrequest_id',
            'reportrequest_id'=>"required|numeric"
        ]);

        if (!$validator->fails()){
           
            $items_reportrequest->requested_amount=$request['amount'];
            $items_reportrequest->amount_in_store=$request['amount_in_store'];
            $items_reportrequest->item_id=$request['item_id'];
            $items_reportrequest->reportrequest_id=$request['reportrequest_id'];
             
            $items_reportrequest->save();
            
            return redirect('/requestselected/'.$items_reportrequest->reportrequest_id)->with('success','successfully saved');
        }
        else{
             return redirect()->back()->withErrors($validator)->withInput();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $items_reportrequest = items_reportrequest::find ( $request->id );
        $items_reportrequest->requested_amount=$request['requested_amount'];
        $items_reportrequest->save ();
        return response ()->json ( $items_reportrequest );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      

         items_reportrequest::find ( $request->id )->delete ();
        return response ()->json ();
    }


//     private function AddUpdateCore($items_reportrequest,$request)
//     {
//        $item_id_validation;

//         if( $items_reportrequest->id!=null){
//            $item_id_validation='required|unique_with:items_reportrequests,reportrequest_id,'.$items_reportrequest->id;
    
//         }
//         else{
         
//             $item_id_validation='required|unique_with:items_reportrequests,reportrequest_id';
//         }      
 
//         $validator = Validator::make($request->all(), [
//             'amount'=>'required|numeric',
//             'amount_in_store'=>"required|numeric",
//             'item_id'=>$item_id_validation,
//             'reportrequest_id'=>"required|numeric"
//         ]);

//         if (!$validator->fails()){
//             print_r($validator->fails());
//             print_r("gggggggggggg");
//             $items_reportrequest->requested_amount=$request['amount'];
//             $items_reportrequest->amount_in_store=$request['amount_in_store'];
//             $items_reportrequest->item_id=$request['item_id'];
//             $items_reportrequest->reportrequest_id=$request['reportrequest_id'];
             
//             $items_reportrequest->save();
            
//             return redirect('/requestselected/{{items_reportrequest->reportrequest_id}}')->with('success','successfully saved');
//         }
//         else{
//              return redirect()->back()->withErrors($validator)->withInput();
//         }

// //             print_r($validator->fails());
// // die(" dddd");

 
    
//     }


    public function seedinfo($id){

        $selected_items = session('selected_items_for_report');
        session(['selected_items_for_report' => "0"]);

    
       
        if( $selected_items !=0){
            $arrray_selected_items_for_report  = explode(",", $selected_items);
            $selected_items = item::whereIn('id',$arrray_selected_items_for_report)->get();

            foreach($selected_items as $item) 
            {
            
                $result=DB::table('items_reportrequests')->where('reportrequest_id', '=', $id)->where('item_id', '=', $item->id)->get();
               
                if(count($result)==0){

                    $items_reportrequest=new items_reportrequest();
                    $items_reportrequest->amount_in_store=app('App\Http\Controllers\QuantityController')->QuanitiyPerItem($item->id);
                    $items_reportrequest->item_id=$item->id;
                
                    $items_reportrequest->reportrequest_id=$id;
                    $items_reportrequest->save();
                }
            }
        }
        $reportrequest= reportrequest::find($id);
       
        return view('stores.requestreport')->with("reportrequest",$reportrequest); 



    }
}
