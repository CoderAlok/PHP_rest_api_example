<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    private $tb_name;

    public function __construct(){ 
        $this->tb_name = 'tbl_users';
    }

    public function get_all_users(){
        $res = $this->db->get($this->tb_name);
        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }
    
    public function get_users_by_id($params){
        $res = $this->db->get_where($this->tb_name, ['uid'=>$params['id']]);
        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }
    
    public function get_customer_by_id($params){
        $res = $this->db->get_where($this->tb_name, ['uid'=>$params['uid'], 'user_type'=>'3']);
        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load.'];
        }

    }
    
    public function get_customer_by_email($params){
        $res = $this->db->get_where($this->tb_name, ['email'=>$params['email']]);
        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'Email available.', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'The email address doesn\'t exists.'];
        }

    }
    
    public function upd_cust_code_by_email($params){
        $this->db->where('email', $params['email']);
        $res = $this->db->update($this->tb_name, ['code'=>$params['code']]);
        if($res){
            return ['status'=>true, 'message'=>'Code changed successfully.'];
        }
        else{
            return ['status'=>false, 'message'=>'failed.'];
        }

    }
    
    public function chk_cust_code_by_email($params){
        $res = $this->db->get_where($this->tb_name, ['email'=>$params['email'], 'code'=>$params['code']]);
        if($res){
            return ['status'=>true, 'message'=>'Code exists.'];
        }
        else{
            return ['status'=>false, 'message'=>'Code doesn\'t exists.'];
        }

    }

    public function check_admin_login($params){
        $res = $this->db->get_where($this->tb_name, ['user_type' => $params['user_type'], 'email'=>$params['email'], 'password'=>sha1($params['password'])]);
        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'failed to load'];
        }

    }

    public function check_farmer_login($params){
        $res = $this->db->get_where($this->tb_name, ['user_type' => $params['user_type'], 'email'=>$params['email'], 'password'=>sha1($params['password'])]);
        if(!empty($res->result())){
            return ['status'=>true, 'message'=>'loaded successfully', 'data'=>$res->result_array()];
        }
        else{
            return ['status'=>false, 'message'=>'sorry, wrong username or password.'];
        }

    }

    public function add_user($params){
        $chk_user = $this->db->get_where($this->tb_name, ['email'=>$params['email']]);
        if(empty($chk_user->result_array())){
            $res = $this->db->insert($this->tb_name, $params);
            if($res){
                return ['status'=>true, 'message'=>'User created successfully.'];
            }
            else{
                return ['status'=>false, 'message'=>'Failed to add.'];
            }
        }
        else{
            return ['status'=>false, 'message'=>'User already existed.'];
        }

    }
    
    public function change_password($params){
        $data = [
                'password'=>sha1($params['new_pass'])
            ];

        $chk_user = $this->db->get_where($this->tb_name, ['email'=>$params['email'], 'password'=>sha1($params['old_pass'])]);

        if(!empty($chk_user->result_array())){
            $this->db->where('email', $params['email']);
            $res = $this->db->update($this->tb_name, $data);

            if($res){
                return ['status'=>true, 'message'=>'Password changed successfully.'];
            }
            else {
                return ['status'=>false, 'message'=>'Failed to change the password.'];
            }

        }
        else{
            return ['status'=>false, 'message'=>'user doesn\'t exists.'];
        }
        
    }
    public function forgot_change_pass($params){
        $data = [
                'password'=>sha1($params['new_pass']),
                'code'=>'0'
        ];

        $this->db->where('email', $params['email']);
        $res = $this->db->update($this->tb_name, $data);

        if($res){
            return ['status'=>true, 'message'=>'Your password has been changed. Now you can login with your new password.'];
        }
        else {
            return ['status'=>false, 'message'=>'Failed to change the forgot password.'];
        }
            
        
    }
    
    public function upd_user_by_id($params){
        $data = $params['data'];

        $chk_user = $this->db->get_where($this->tb_name, ['uid'=>$params['id']]);

        if(!empty($chk_user->result_array())){
            $this->db->where('uid', $params['id']);
            $res = $this->db->update($this->tb_name, $data);

            if($res){
                return ['status'=>true, 'message'=>'updated successfully.'];
            }
            else {
                return ['status'=>false, 'message'=>'added successfully.'];
            }
            
        }
        else{
            return ['status'=>false, 'message'=>'user doesn\'t exists.'];
        }
        
    }

    public function del_user_by_id($params){
        $res = $this->db->delete($this->tb_name, array('uid' => $params['id']));

        if($res){
            return ['status'=>true, 'message'=>'deleted successfully.'];
        }
        else{
            return ['status'=>false, 'message'=>'failed to delete.'];
        }
        
    }
    
    public function del_user_by_username($params){
        // $sql = 'DELETE FROM '.$this->tb_name.' WHERE username = "'.$params.'"';
        // $res = $this->db->query($sql);
        $res = $this->db->delete($this->tb_name, array('username' => $params));

        if($res){
            return ['status'=>true, 'message'=>'deleted successfully.'];
        }
        else{
            return ['status'=>false, 'message'=>'failed to delete.'];
        }
        
    }

    
    
}


