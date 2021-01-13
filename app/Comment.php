<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'writter_name',
        'writter_email',
        'comment_text',
        'ticket_id',
        'user_id',
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
