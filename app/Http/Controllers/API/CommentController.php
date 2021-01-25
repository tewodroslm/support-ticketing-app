<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\ModifiedComment;
use Illuminate\Support\Facades\DB;

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

    public function getComment($id){
        
        $comments = DB::table('comments')->where('ticket_id', $id)->get();
        $comms = array();
        foreach($comments as $comment){
            $modifiedComment = new ModifiedComment();
        
            $modifiedComment->set_writter_name($comment->writter_name);

            $modifiedComment->set_writter_email($comment->writter_email);
            $modifiedComment->set_comment_text($comment->comment_text);
            $modifiedComment->set_ticket_id($comment->ticket_id);
            $modifiedComment->set_user_id($comment->user_id);
            
            $user = User::find($comment->user_id);
            $userRole = $user->roles()->first();
            $modifiedComment->set_user_role($userRole->role);

            array_push($comms, $modifiedComment);
        }
        

        if(!is_null($comment)){
            return response()->json(['success' => true, 'comms' => $comms]);
        }

    }
}
