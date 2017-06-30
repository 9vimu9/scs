<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SuggestsController extends Controller
{
    public function suggest(Request $request)
    {
        
        $term = trim($request->q);
        $table = trim($request->t);
        $column = trim($request->c);

        if (empty($term)) {
            return \Response::json([]);
        }

        $results = array();
        $results =  DB::table($table)->where($column, '=', $term)->orWhere($column, 'LIKE', '%' . $term . '%')->get(['id', $column.' as value']);
        return response()->json($results);
    }
}
