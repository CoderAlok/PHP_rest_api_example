<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// include REST_Controler library
require APPPATH. '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Products extends REST_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('books_model', 'books');
	}

	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	// }

// This are traditional approach with model and controller
	public function get_all_books(){

		$r = $this->books->get_all_books();
		echo json_encode($r);

	}

	public function add_books(){
		// Pass JSON data.
		$inputs = json_decode($this->input->raw_input_stream, true);
		
		echo json_encode($this->books->add_books($inputs));
	}


// This are Rest controller approach with rest controller
	public function index_get($id = 0){
		if(!empty($id)){
			$data = $this->db->get_where($this->tb_name, ['id'=>$id])->row_array();
		}
		else{
			$data = $this->db->get($this->tb_name)->result();
		}
		$this->response($data, REST_Controller::HTTP_OK);

	}

}
