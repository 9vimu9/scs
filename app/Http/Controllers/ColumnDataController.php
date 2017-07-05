<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
class ColumnDataController extends Controller
{
    
     public function GetColumnData(Request $request)
    {
        
        $id = trim($request->q);
        $column = trim($request->c);
        $table = trim($request->t);
        

        if (empty($id)) {
            return \Response::json([]);
        }

     //  $data=item::find($id)[$column];
        return DB::table($table)->select(DB::raw($column))->where("id", '=', $id)->value($column);
      
    }
}
