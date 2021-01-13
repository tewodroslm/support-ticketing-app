<?php

namespace App\Http\Controllers\API;
use App\Priority;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    
    public function create(Request $request){
        
        $validator = $request->validate([
            'name' => 'required',
        ]);
        
        $priority = Priority::create($validator);

        if(!is_null($priority)){
            return response()->json(['success' => true, 'message' => 'Priority added!']);
        }else{
            return response()->json(['Error' => 'Failed to create priority!']);
        }
    }

}
