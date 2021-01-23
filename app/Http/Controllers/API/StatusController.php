<?php

namespace App\Http\Controllers\API;

use App\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    
    public function create(Request $request){
        
        $validator = $request->validate(['name' => 'required']);

        $status = Status::create($validator);

        if(!is_null($status)){
            return response()->json(['success' => true, 'message' => 'Status added!']);
        }else{
            return response()->json(['Error' => 'Failed to create Status!']);
        }

    }

    public function getStatus(){

        $statuses = Status::all();

        return response()->json(["statuses" => $statuses]);

    }
}
