<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
	}
	
	public function send_otp_mail($params){
        $from_email = "_mainaccount@my-demo.xyz";
        $to_email = $params['to']; //"alokdas4all@gmail.com";
        $subject = $params['subject']; //"Test message ..asa.";
        $message = $params['message']; //"This is a test message for Farmers. PORTO RICO";
	    
	   // Load email library
        $this->load->library('email');
        
       // Setting the config
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.my-demo.xyz';
        $config['smtp_user'] = '_mainaccount@my-demo.xyz';
        $config['smtp_pass'] = 'jV2{Uh,K(!sx';
        $config['smtp_port'] = 587;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        
        $this->email->from($from_email, "Fresh");
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
	   
	   //Send mail
        if($this->email->send()){
            $res = ["status"=>"true", "message"=>"Mail sent successfully."];
        }
        else{
            $res = ["status"=>"false", "message"=>"Mail sending failed."];
        }
        
        return $res;

	}

}