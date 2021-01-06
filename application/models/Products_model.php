<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

    private $tb_name;

    public function __construct(){ 
        $this->tb_name = 'tbl_products';
    }

    public function get_all_products(){
        // $res = $this->db->get($this->tb_name);
        $sql = 'SELECT pid, cid, (SELECT name FROM tbl_categories WHERE tbl_categories.cid = tbl_products.cid) as Catagory, type, image, name, description, cost_price, sell_price, unit, total_qty, created_at, updated_at, created_by FROM tbl_products ORDER BY tbl_products.created_at DESC';
        $res = $this->db->query($sql);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }
    
    public function get_product_by_id($params){
        $res = $this->db->get_where($this->tb_name, ['pid'=>$params['id']]);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }
    
    public function get_product_by_name($params){
        $res = $this->db->get_where($this->tb_name, ['name'=>$params['name']]);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }
    
    public function get_product_by_catagory($params){
        $res = $this->db->get_where($this->tb_name, ['cid'=>$params['cid']]);

        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }

    public function add_product($params){
        $chk_user = $this->db->get_where($this->tb_name, ['name'=>$params['name']]);

        if(empty($chk_user->result_array())){
            $res = $this->db->insert($this->tb_name, $params);
            if($res){
                return ['status'=>true, 'message'=>'added successfully.'];
            }
            else{
                return ['status'=>false, 'message'=>'Failed to add.'];
            }
        }
        else{
            return ['status'=>false, 'message'=>'Product already existed.'];
        }

    }
    
    public function upd_product_by_id($params){

        // echo '<pre>'; print_r($params);

        $data = $params['data'];

        $chk_user = $this->db->get_where($this->tb_name, ['pid'=>$params['id']]);

        if(!empty($chk_user->result_array())){
            $this->db->where('pid', $params['id']);
            $res = $this->db->update($this->tb_name, $data);

            if($res){
                return ['status'=>true, 'message'=>'updated successfully.'];
            }
            else {
                return ['status'=>false, 'message'=>'added successfully.'];
            }

        }
        else{
            return ['status'=>false, 'message'=>'Product doesn\'t exists.'];
        }

    }

    public function upd_product_by_name($params){

        // echo '<pre>'; print_r($params);

        $data = $params['data'];

        $chk_user = $this->db->get_where($this->tb_name, ['name'=>$params['pname']]);

        if(!empty($chk_user->result_array())){
            $this->db->where('name', $params['pname']);
            $res = $this->db->update($this->tb_name, $data);

            if($res){
                return ['status'=>true, 'message'=>'updated successfully.'];
            }
            else {
                return ['status'=>false, 'message'=>'added successfully.'];
            }

        }
        else{
            return ['status'=>false, 'message'=>'Product doesn\'t exists.'];
        }

    }

    public function del_product_by_id($params){
        $chk_user = $this->db->get_where($this->tb_name, ['pid'=>$params['id']]);

        if(!empty($chk_user->result_array())){
            $res = $this->db->delete($this->tb_name, array('pid' => $params['id']));

            if($res){
                return ['status'=>true, 'message'=>'deleted successfully.'];
            }
            else{
                return ['status'=>false, 'message'=>'failed to delete.'];
            }

        }
        else{
            return ['status'=>false, 'message'=>'Product doesnot exists.'];
        }

    }

    public function del_product_by_name($params){
        $chk_user = $this->db->get_where($this->tb_name, ['name'=>$params['pname']]);

        if(!empty($chk_user->result_array())){
            $res = $this->db->delete($this->tb_name, array('name' => $params['pname']));

            if($res){
                return ['status'=>true, 'message'=>'deleted successfully.'];
            }
            else{
                return ['status'=>false, 'message'=>'failed to delete.'];
            }

        }
        else{
            return ['status'=>false, 'message'=>'Product doesnot exists.'];
        }

    }
    
    public function del_all_products(){

        $res = $this->db->delete($this->tb_name);

        if($res){
            return ['status'=>true, 'message'=>'All products deleted successfully.'];
        }
        else{
            return ['status'=>false, 'message'=>'failed to delete.'];
        }

    }
    
}

