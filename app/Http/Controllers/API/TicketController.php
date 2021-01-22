<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use App\Ticket;
use App\Status;
use App\Priority;
use App\Comment;
use App\User;
use App\ReturnTicket;
use App\ReturnAdminTickets;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    
    public function create(Request $request){
        
        $validator = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'sender_email' => 'required|email',
        ]);
        
        $request->request->add([
            'status_id'     => 3,
            'priority_id'   => 2
        ]);

        $ticket = Ticket::create($request->all());

        if(!is_null($ticket)){
            return response()->json(['success' => true, 'message' => 'Ticket Created']);
        }else{
            return response()->json(['Error' => 'Failed to create ticket !!']);
        }

    }

    // Show all the ticket to the admin
    public function showAll(){
        
        $tickets = Ticket::all();
        $ticks = [];
        $comments = Comment::all();
        for($i=0; $i<count($tickets); $i++){
            $returnedTicket = new ReturnAdminTickets();
            $returnedTicket->set_id($tickets[$i]->id);
            $returnedTicket->set_title($tickets[$i]->title);
                
            $comment = $comments->where('ticket_id', $tickets[$i]->id);
            // if(sizeof($comment[0]) <= 0){
              //  $returnedTicket->set_comment("No comment yet!");
            //}else{
            $returnedTicket->set_comment($comment);
            //}
            $prior = Priority::find($tickets[$i]->priority_id);
            $returnedTicket->set_priority($prior->name);
            $returnedTicket->set_description($tickets[$i]->description);
            $returnedTicket->set_senderemail($tickets[$i]->sender_email);
            $user = User::find($tickets[$i]->handler_user_id);
            $returnedTicket->set_handler_id($user->name);
            $status = Status::find($tickets[$i]->status_id);
            $returnedTicket->setStatus($status->name);
            array_push($ticks, $returnedTicket);
        }

        if(count($ticks)>0){
            return response()->json(["count" => count($ticks), "tickets" => $tickets, "detickets" => $ticks]);
        }
    }

    //Show basic users their sent tickets
    public function show(){

        $ticks = [];
        
        $user = Auth::user();

        $tickets = Ticket::all();
        $comments = Comment::all();
        for($i=0; $i<count($tickets); $i++){
            if($tickets[$i]->sender_email == $user->email){
                $returnedTicket = new ReturnTicket();
                $returnedTicket->set_id($tickets[$i]->id);
                $returnedTicket->set_title($tickets[$i]->title);

                
                $comment = $comments->where('ticket_id', $tickets[$i]->id);
                if(sizeof($comment) <= 0){
                    $returnedTicket->set_comment("No comment yet!");
                }else{
                    $returnedTicket->set_comment($comment[0]->comment_text);
                }
                
                $returnedTicket->set_description($tickets[$i]->description);
                $returnedTicket->set_senderemail($tickets[$i]->sender_email);
                $status = Status::find($tickets[$i]->status_id);
                $returnedTicket->setStatus($status->name);
                array_push($ticks, $returnedTicket);
            }
        }
       
        if(count($ticks)>0){
            return response()->json(["count" => count($ticks), "tickets" => $ticks]);
        }else{
            return response()->json(["message" => "Whoops! no ticket found"]);
        }

    }
    
    // Show ticket to moderator
    public function showMTicket(){
        $tickets = Ticket::all();
        $user = Auth::user();
        $ticks = [];
        $comments = Comment::all();
        for($i=0; $i<count($tickets); $i++){
            if($tickets[$i]->handler_user_id == $user->id){
                $returnedTicket = new ReturnAdminTickets();
                $returnedTicket->set_id($tickets[$i]->id);
                $returnedTicket->set_title($tickets[$i]->title);

                $comment = $comments->where('ticket_id', $tickets[$i]->id);
                // if(sizeof($comment[0]) <= 0){
                  //  $returnedTicket->set_comment("No comment yet!");
                //}else{
                $returnedTicket->set_comment($comment);
                //}
                $prior = Priority::find($tickets[$i]->priority_id);
                $returnedTicket->set_priority($prior->name);
                $returnedTicket->set_description($tickets[$i]->description);
                $returnedTicket->set_senderemail($tickets[$i]->sender_email);
                $user = User::find($tickets[$i]->handler_user_id);
                $returnedTicket->set_handler_id($user->name);
                $status = Status::find($tickets[$i]->status_id);
                $returnedTicket->setStatus($status->name);
                array_push($ticks, $returnedTicket);
            }
        }
        return response()->json(["count" => count($ticks), "tickets" => $ticks]);
    }

    public function update(Request $request, $id){
        
        $ticket = Ticket::find($id);
        
        $validator = $this->getValidator($request, $ticket->$id);

        if ($validator->fails()) {
            return response()->json(['Error'=>"Error has occured during validation"]);
        }
        
        $ticket->update($request->all());

        return $ticket;

    }

    public function getValidator(Request $request){
        $rules = [
            'title'=>'required|string',
            'status_id'=>'required|integer',
            'priority_id'=>'required',
            'handler_user_id' =>'integer'
        ];
        return Validator::make($request->all(), $rules);
    }

    public function destroy($id){
        $ticket = Ticket::find($id);
        $ticket->delete();
        return response()->json(['success'=>'Deleted successfully']);
    }


    public function saveComment(Request $request){
        //
    }

}
