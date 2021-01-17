<?php

namespace App;

class ReturnTicket 
{

	public $title;
	public $description;
	public $sender_email;
	public $status;

  // Methods
  function set_title($title) {
    $this->title = $title;
	}
	function set_description($description) {
    $this->description = $description;
	}
	function set_senderemail($sender_email) {
    $this->sender_email = $sender_email;
  }
	function setStatus($status) {
    $this->status = $status;
  }
  function get_title() {
    return $this->title;
  }

}
