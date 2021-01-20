<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request){
        $validator = $request->validate([
            'writter_name' => 'required',
            'writter_email' => 'required|email',
            'comment_text' => 'required',
            'ticket_id'  => 'required',
            'user_id' => 'required',
        ]);
        $comment = Comment::create($request->all());
        if(!is_null($comment)){
            return response()->json(['success' => true, 'comment' => 'Comment Created']);
        }
    }
}
