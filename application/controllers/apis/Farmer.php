<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// include REST_Controler library
// require APPPATH. '/libraries/REST_Controller.php';

class farmer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('users_model', 'user');
		$this->load->model('catagories_model', 'cat');
		$this->load->model('products_model', 'pro');
		$this->load->model('stocks_model', 'sto');
		$this->load->model('email_model', 'mail');
		$this->load->model('otp_model', 'otp');
		
		$this->load->helper(['form', 'utility']);

		$this->load->library('session');
		
		// $this->load->model('user', '');
	}

	public function login(){
		// Pass JSON data 
		// $inputs = json_decode($this->input->raw_input_stream, true);
		
		// Pass POST data
		$inputs = $this->input->post();
		
		$params = [
			'user_type' => $inputs['user_type'],
			'username' => $inputs['username'],
			'password' => $inputs['password']
		];
		$res = $this->user->check_farmer_login($params);
        echo json_encode($res);
    }

    public function register(){

        // Pass JSON data
		// $inputs = json_decode($this->input->raw_input_stream, true);
		
		// Pass POST data
		$params = [
			'user_type' => $this->input->post('user_type'),
			'username' 	=> $this->input->post('username'),
			'password' 	=> sha1($this->input->post('password')),
			'name' 		=> $this->input->post('name'),
			'age' 		=> $this->input->post('age'),
			'gender' 	=> $this->input->post('gender'),
			'email' 	=> $this->input->post('email'),
			'phone' 	=> $this->input->post('phone'),
			'address' 	=> $this->input->post('address'),
			'town' 		=> $this->input->post('town'),
			'country' 	=> $this->input->post('country')
		];

        $token = generateRandomString(6);
        $_mail['to'] = $params['email'];
        $_mail['subject'] = "Token from Fresh on the Go";
        $_mail['message'] = 'Your generated token is '.$token;
        
        $r = $this->mail->send_otp_mail($_mail);
        if($r['status']){
            $o = $this->otp->add_otp(['otp'=>$token]);
            if($o['status']){
                $res = $this->user->add_user($params);
                if($res['status']){
		            echo json_encode($res);
                }
                else{
                    echo json_encode($res);
                }
                
		    }
		    else{
		        echo json_encode($o);
		    }
        }
        else{
            echo json_encode($r);
        }

    }
    
    public function upd_usr_after_otp(){
        $params = [
            'user_type'=>'2',
            'username'=>$this->input->post('username'),
            'otp'=>$this->input->post('otp')
        ];
        
        $r = $this->otp->get_details_by_otp($params);
        if($r['status']){
            echo json_encode($r);
        }
        else{
            $res = $this->user->del_user_by_username($params['username']);
            if($res['status']){
                echo json_encode($res);
            }
            else{
                echo json_encode($res);
            }

        }
        
    }
    
    

}


