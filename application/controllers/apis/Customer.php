<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// include REST_Controler library
// require APPPATH. '/libraries/REST_Controller.php';

class customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		ob_start();
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('users_model', 'user');
		$this->load->model('catagories_model', 'cat');
		$this->load->model('products_model', 'pro');
		$this->load->model('stocks_model', 'sto');
		$this->load->model('email_model', 'mail');
		$this->load->model('otp_model', 'otp');
		
		$this->load->helper(['form', 'utility']);

		$this->load->library('session');
		$this->load->library('upload');
		
		// $this->load->model('user', '');
	}

	public function login(){
		// Pass JSON data.
		$inputs = json_decode($this->input->raw_input_stream, true);
		
		// Pass POST data
 		// $inputs = $this->input->post();
		
		$params = [
			'user_type' => $inputs['user_type'],
			'email' => $inputs['email'],
			'password' => $inputs['password']
		];
		$res = $this->user->check_farmer_login($params);
		
		if($res['status']){
		    $this->session->set_userdata(
		        [
		            'uid'=>$res['data'][0]['uid'], 
		            'user_type'=>$res['data'][0]['user_type'], 
		            'email'=>$res['data'][0]['email'], 
		            'name'=>$res['data'][0]['name']
		        ]);
		    exit(json_encode($res));
		}
		else{
		    exit(json_encode($res));
		}
        
    }

    public function register(){

        // This is to get the inputs from json in insomnia.
		$inputs = json_decode($this->input->raw_input_stream, true);

        $params = [
			'user_type' => $inputs['user_type'],
			'email' 	=> $inputs['email'],
			'password' 	=> sha1($inputs['password'])
		];

        $token = generateRandomString(6);
        $_mail['to'] = $params['email'];
        $_mail['subject'] = "Token from Fresh on the Go";
        $_mail['message'] = 'Your generated token is '.$token;

        // Token sent in mail.
        $r = $this->mail->send_otp_mail($_mail);

        if($r['status']){
            $o = $this->otp->add_otp(['otp'=>$token]);
            if($o['status']){
                $this->session->set_userdata('password', $params['password']);
                exit(json_encode($o));
		    }
		    else{
		        exit(json_encode($o));
		    }
        }
        else{
            exit(json_encode($r));
        }

	}
	
	public function upd_usr_after_otp(){

		$inputs = json_decode($this->input->raw_input_stream, true);

        $params = [
			'user_type' => $inputs['user_type'],
			'email' 	=> $inputs['email'],
			'password' 	=> $this->session->userdata('password'),
			'otp' 	    => $inputs['otp']
		];
   
        $r = $this->otp->get_details_by_otp($params);

        if($r['status']){
            
            $p = [
                'user_type'=>$params['user_type'],
                'email'=>$params['email'],
                'password'=>$this->session->userdata('password')
            ];

            $res = $this->user->add_user($p);

            if($res['status']){
	            echo json_encode($res);
            }
            else{
                echo json_encode($res);
            }
            
        }
        else{
            echo json_encode($r);
        }
        
    }
	
    public function logout(){
        $this->load->driver('cache'); # add
        $this->session->sess_destroy(); # Change
        $this->cache->clean();  # add
        // redirect('home'); # Your default controller name 
        // ob_clean(); # add
    }

	public function updadmin(){
		$inputs = json_decode($this->input->raw_input_stream, true);
		
		$params = [
			'user_type' => $inputs['user_type'],
			'username' => $inputs['username'],
			'password' => sha1($inputs['password']),
			'name' => $inputs['name'],
			'age' => $inputs['age'],
			'gender' => $inputs['gender'],
			'phone' => $inputs['phone'],
			'address' => $inputs['address'],
			'town' => $inputs['town'],
			'country' => $inputs['country'],
		];
		$res = $this->user->add_user($params);
		exit(json_encode($res));
	}
	
	public function send_forgot_pass_token(){
    	$inputs = json_decode($this->input->raw_input_stream, true);
	    
	    $params = [
	        'email' => $inputs['email']
        ];
        
		$res = $this->user->get_customer_by_email($params);
		if($res['status']){
		    
	        $token = generateRandomString(4);
            $_mail['to'] = $params['email'];
            $_mail['subject'] = "Forgot password";
            $_mail['message'] = 'Your generated token for forgot password is '.$token;
            
            $r = $this->mail->send_otp_mail($_mail);
            if($r['status']){
                
                $param_user = ['email'=>$params['email'], 'code'=>$token];
                $cr = $this->user->upd_cust_code_by_email($param_user);
                
                if($cr['status']){
                    echo json_encode($cr);
                }
                else{
                    echo json_encode($cr);
                }
                
                // Need to work from here with forgot passsword .. mail sending is successful. 'We have sent a password reset otp to your email - alokdas4all@gmail.com'. 
                // 'You have entered an incorect code!'
                // ''
            }
            else{
                echo json_encode($r);
            }
		}
		else{
		    echo json_encode($res);
		}
	}
	
	public function forgot_change_pass(){
	    $inputs = json_decode($this->input->raw_input_stream, true);
	    
	    $params = [
	        'email'     => $inputs['email'],
	        'code'      => $inputs['code'],
	        'old_pass'  => $inputs['old_pass'],
	        'new_pass'  => $inputs['new_pass']
        ];
	   // $params = [
	   //     'email' => $this->input->post('email'),
	   //     'code' => $this->input->post('code'),
	   //     'old_pass' => $this->input->post('old_pass'),
	   //     'new_pass' => $this->input->post('new_pass')
    //     ];
        
        $chk1 = $this->user->chk_cust_code_by_email($params);
        if($chk1['status']){
            $res = $this->user->forgot_change_pass($params);
    		if($res['status']){
                echo json_encode($res);
    		}
    		else{
    		    echo json_encode($res);
    		}

        }
        else{
            echo json_encode($chk1);
        }

	}
	
	public function change_pass(){
	    
	    $inputs = json_decode($this->input->raw_input_stream, true);

	    $params = [
	        'email'     => $inputs['email'],
	        'old_pass'  => $inputs['old_pass'],
	        'new_pass'  => $inputs['new_pass']
        ];
	   // $params = [
	   //     'email' => $this->input->post('email'),
	   //     'old_pass' => $this->input->post('old_pass'),
	   //     'new_pass' => $this->input->post('new_pass')
       //     ];
		$res = $this->user->change_password($params);
		if($res['status']){
            echo json_encode($res);
		}
		else{
		    echo json_encode($res);
		}
	}

	public function deladmin(){
		
	}

	public function get_details_by_id(){
		// Pass JSON data.
		// $inputs = json_decode($this->input->raw_input_stream, true);
		
		// Pass POST data
		$inputs = $this->input->get();
		
		$params = [
			'uid' => $inputs['id']
		];
		$res = $this->user->get_customer_by_id($params);
        echo json_encode($res);
    }

	public function get_details_by_email(){
		$params = ['email' => $this->input->post('email')];
		$res = $this->user->get_customer_by_email($params);
        echo json_encode($res);
    }
    
    public function cust_profile_img_up(){
        // to pass json inputs
        // $inputs = json_decode($this->input->raw_input_stream, true);
        
        // echo json_encode($_FILES['userfile']);
        // exit;
        
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 102400;
        $config['max_height']           = 7680;
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());
        
            echo json_encode($error);
            // $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            echo json_encode($data);
            // $this->load->view('upload_success', $data);
        }

    }
    
    public function test_upl(){
        // echo "hello";
        $this->load->view('test1');
    }

}


