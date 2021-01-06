<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');

		$this->load->model('products_model', 'pro');
		
		$this->load->helper('form');

		$this->load->library('session');
	}

	public function searchallproduct(){
		$res = $this->pro->get_all_products();
        exit(json_encode($res));
    }

	public function searchproductbyid(){
		$params = [
			'id' => $this->input->get('pid')
		];
		$res = $this->pro->get_product_by_id($params);
        exit(json_encode($res));
    }

	public function searchproductbyname(){
		$params = [
			'name' => $this->input->get('pname')
		];
		$res = $this->pro->get_product_by_name($params);
        exit(json_encode($res));
    }

	public function searchproductbycatagory(){
		$params = [
			'cid' => $this->input->get('cid')
		];
		$res = $this->pro->get_product_by_catagory($params);
        exit(json_encode($res));
    }

	public function delproductbyid(){
		$params = [
			'id'=>$this->input->get('pid'),
		];
        $r = $this->pro->del_product_by_id($params);
        exit(json_encode($r));
    }

	public function delproductbyname(){
		$params = [
			'pname'=>$this->input->get('pname'),
		];
        $r = $this->pro->del_product_by_name($params);
        exit(json_encode($r));
    }

	public function delallproduct(){
        $r = $this->pro->del_all_products();
        exit(json_encode($r));
    }
    
    public function addproducts(){
        // Pass JSON data
        // $res = $this->pro->add_product(json_decode($this->input->raw_input_stream, true));
        
        // Pass POST data
        $res = $this->pro->add_product($this->input->post());
        exit(json_encode($res));
    }

    public function updproductsbyid(){
        // Pass JSON data
		// $inputs = json_decode($this->input->raw_input_stream, true);
		
		// Pass POST data
		$inputs = $this->input->post();
		$inputs['updated_at'] = date('Y-m-d H:i:s');
		$params = [
			'id'=>$inputs['pid'],
			'data'=>$inputs
		];
			
        $r = $this->pro->upd_product_by_id($params);
        exit(json_encode($r));
    }

    public function updproductsbyname(){
		$inputs = json_decode($this->input->raw_input_stream, true);
		$params = [
			'pname'=>$inputs['pname'],
			'data'=>$inputs  
		];
			
        $r = $this->pro->upd_product_by_name($params);
        exit(json_encode($r));
    }

}


