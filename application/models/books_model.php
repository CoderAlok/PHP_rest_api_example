<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class books_model extends CI_Model {

    private $tb_name;

    public function __construct(){ 
        $this->tb_name = 'books';

        parent::__construct();
    }

    public function get_all_books(){
        $res = $this->db->get($this->tb_name);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'Books loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'Failed to load boots'];
        }

    }

    public function add_books($params){
    	$res = $this->db->insert($this->tb_name, $params);
    	if($res){
    		return ['status'=>true, 'message'=>'Books added successfully.'];
    	}
    	else{
    		return ['status'=>false, 'message'=>'Failed to add books.'];
    	}
    }

}