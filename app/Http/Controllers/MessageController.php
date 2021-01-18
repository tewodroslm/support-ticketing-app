<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function store(Request $request){

        $conversation = Message::create([
            'message' => $request->message,
            'from_user' => $request->from_user,
            'to_user' => $request->to_user,
        ]);
        
        broadcast(new MessageSent($conversation));

        return  response()->json(["message" => $conversation]);
    }

    public function fetchMessage(){
        
        $messages = Message::all();
    
        return response()->json(["message" => $messages]);
    
    }

}
