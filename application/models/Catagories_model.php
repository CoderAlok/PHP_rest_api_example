<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catagories_model extends CI_Model {

    private $tb_name;

    public function __construct(){ 
        $this->tb_name = 'tbl_categories';
    }

    public function get_all_catagories(){
        $res = $this->db->get($this->tb_name);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }
    
    public function get_catagory_by_id($params){
        $res = $this->db->get_where($this->tb_name, ['cid'=>$params['id']]);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }

    public function add_catagory($params){
        $chk_user = $this->db->get_where($this->tb_name, ['name'=>$params['name']]);

        if(empty($chk_user->result_array())){
            $res = $this->db->insert($this->tb_name, $params);
            if($res){
                return ['status'=>true, 'message'=>'added successfully.', 'data'=>$res];
            }
            else{
                return ['status'=>false, 'message'=>'Failed to add.', 'data'=>$res];
            }
        }
        else{
            return ['status'=>false, 'message'=>'Catagory already existed.'];
        }

    }
    
    public function upd_catagory_by_id($params){
        $data = $params['data'];

        $chk_user = $this->db->get_where($this->tb_name, ['cid'=>$params['id']]);

        if(!empty($chk_user->result_array())){
            $this->db->where('cid', $params['id']);
            $res = $this->db->update($this->tb_name, $data);

            if($res){
                return ['status'=>true, 'message'=>'updated successfully.'];
            }
            else {
                return ['status'=>false, 'message'=>'added successfully.'];
            }
            
        }
        else{
            return ['status'=>false, 'message'=>'Catagory doesn\'t exists.'];
        }
        
    }

    public function del_catagory_by_id($params){
        $chk_user = $this->db->get_where($this->tb_name, ['cid'=>$params['id']]);

        if(!empty($chk_user->result_array())){
            $res = $this->db->delete($this->tb_name, array('cid' => $params['id']));

            if($res){
                return ['status'=>true, 'message'=>'deleted successfully.', 'data'=>$res];
            }
            else{
                return ['status'=>false, 'message'=>'failed to delete.', 'data'=>$res];
            }

        }
        else{
            return ['status'=>false, 'message'=>'Catagory doesnot exists.'];
        }

    }
    
}


