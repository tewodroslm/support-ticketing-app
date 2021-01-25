<?php

namespace App;

class ModifiedComment 
{

	public $writter_name;
	public $writter_email;
	public $comment_text;
	public $ticket_id;
	public $user_id;
	public $user_role; 


  // Methods
  function set_writter_name($writter_name) {
    $this->writter_name = $writter_name;
  }
  function set_writter_email($writter_email) {
    $this->writter_email = $writter_email;
	}
  function set_comment_text($comment) {
    $this->comment_text = $comment;
  }
	function set_ticket_id($ticket_id) {
    $this->ticket_id = $ticket_id;
	}
	function set_user_id($id){
		$this->user_id = $id;
	}
	function set_user_role($user_role) {
    $this->user_role = $user_role;
	}

}
