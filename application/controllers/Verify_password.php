<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify_password extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->library('encryption');
        if($this->auth_level!=9){
            redirect('/logout');
        }
       // $this->load->model('authentication_model');
    }

    public function index()
    {
        $verify_token=$_GET['verify_token'];
        $client_id = $_GET['client'];
        $view_data['client_id']=$this->encryption->decrypt(base64_decode($client_id));
        $view_data['user_id'] = $this->encryption->decrypt(base64_decode($verify_token));
            
        //print_r($view_data);
         $this->load->view('pages/new_password',$view_data);
       
    }

    public function update_password(){
        $user_id=$this->input->post("user_id");
        $email=$this->mcommon->specific_row_value('users', array('user_id' => $user_id), 'email');
        $client_id=$this->input->post("client_id");
        $login=$this->input->post("login");
        $password=$this->authentication->hash_passwd($login);
        $password_array=array(
            'passwd'=>$password,
            'passwd_modified_at'=>date('Y-m-d h:i:s:a'),
        );
        $update = $this->mcommon->common_edit('users', $password_array, array('email' => $email));
        if($update){
            $client_array=array(
                'is_pass_set'=>1,
            );
            $update2 = $this->mcommon->common_edit('company_master', $client_array, array('company_id'=>$client_id));
            redirect("logout");
        }
    }



}
