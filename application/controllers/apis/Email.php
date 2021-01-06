<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// include REST_Controler library
// require APPPATH. '/libraries/REST_Controller.php';

class Email extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('email_model', 'em');
		$this->load->helper(['form', 'utility']);
	}

	public function test(){
	    echo generateRandomString(6);
	}
	
}