<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketNotification extends Model
{
    protected $fillable = [
        'title',
        'ticket_id'
    ];
}
