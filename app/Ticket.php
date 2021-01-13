<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'sender_email',
        'handler_user_id',
        'status_id',
        'priority_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'handler_user_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function priority(){
        return $this->belongsTo(Priority::class, 'priority_id');
    }

}
