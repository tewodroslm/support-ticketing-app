<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketNotification;

class NotificationController extends Controller
{
    public function getNotifications(){
        $notific = TicketNotification::all();
        return response()->json(["message" => $notific]);
    }

    public function deleteNotification($notificationId){
        if($notificationId == 'undefined' || $notificationId == ""){
            return response()->json(["message" => "Alert! enter the notification id"]);
        }

        $content = TicketNotification::find($notificationId);
        if(!is_null($content)){
            $delete_content = TicketNotification::where("id", $notificationId)->delete();
            return response()->json(["message" => "Deleted success"]);
        }
    }
}

