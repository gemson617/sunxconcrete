<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        // if($this->auth_level!=9){
        //     redirect('/logout');
        // }
    }
    public function index()
    {
        if ($this->verify_min_level(1)) {
            // $view_data['datatable'] = $this->datatable();
            $view_data['add_option'] = 1;
            $view_data['edit_option'] = 1;
            $view_data['delete_option'] = 1;
            $view_data['default'] = $this->mcommon->specific_row('users', array('user_id' => $this->auth_user_id));
            $view_data['role'] = $this->mcommon->records_all('role_master',array('status'=>'1','id'));
            $data = array(
                'page_title' => 'Users Profile',
                'title' => 'Users Profile',
                'content' => $this->load->view('pages/users_profile/edit', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }
 




    public function check_user_exists(){
		$this->db->select("*");
		$this->db->from("client_master");
		$result = $this->db->get()->result();
        $us=array();
		foreach($result as $res){
			$user_id_used=$this->mcommon->specific_row_value('users', array('user_id' => $res->user_id), 'user_id');
            $email=$this->mcommon->specific_row_value('client_master', array('emp_id' => $res->emp_id), 'official_email');
			if($user_id_used=='' && $email!=""){
                $us[]=$res->emp_id;
                $pass = "Welcome@123";
                $user_id = $this->get_unused_id();
                $insert_array = array(
                    'user_id' => $user_id,
                    'username' => $email,
                    'email' => $email,
                    'mobile' => 0,
                    'auth_level' => 7,
                    'banned' => 0,
                    'passwd' => $this->authentication->hash_passwd($pass),
                    'device_id' => "",
                    'profile_pic' => "",
                    'cover_pic' => "",
                    'status' => 1,
                );
                $user = $this->db->insert("users", $insert_array);
                $employee_update = $this->mcommon->common_edit('client_master', array("user_id"=>$user_id), array('emp_id' => $res->emp_id));
			}
		}

        // echo "<pre>";
        // print_r($us);
        // die();
	}
    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values
            $email = $this->input->post('email');
            $contact_number = $this->input->post('contact_number');            
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $address = $this->input->post('address');
            if ($password) {
                $user_array = array(
                    "username" => $email,
                    "email" => $email,
                    "mobile" => $contact_number,               
                    "passwd" => $this->authentication->hash_passwd($password), 
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,  
                );
                $update_pass = $this->mcommon->common_edit('users', $user_array, array('user_id' => $id));
                if ($update_pass) {
                    $this->session->set_flashdata('alert_success', 'Users updated successfully!');
                    redirect('users_profile/edit');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
            else{
                     //prepare update array
                    $update_array = array(
                        "username" => $email,
                        "email" => $email,
                        "mobile" => $contact_number, 
                        "first_name" => $first_name,
                        "last_name" => $last_name,
                        "address" => $address,
                    );
                    //insert values in database
                    $update = $this->mcommon->common_edit('users', $update_array, array('user_id' => $id));
            //         print_r($insert);
            // exit();
                    if ($update) {
                        $this->session->set_flashdata('alert_success', 'Users updated successfully!');
                        redirect('Users');
                    } else {
                        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                    }
            }
            
        }

        $view_data['default'] = $this->mcommon->specific_row('users', array('user_id' => $id));
        $view_data['role'] = $this->mcommon->records_all('role_master',array('status'=>'1','id'));
        // print_r($view_data['default']);
        // exit();
        $data = array(
            'title' => 'Edit Users Profile',
            'content' => $this->load->view('pages/users_profile/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
    public function get_unused_id()
    {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand(-2147482448, 2147483647);

        // Make sure the random user_id isn't already in use
        $query = $this->db->where('user_id', $random_unique_int)
            ->get_where($this->db_table('user_table'));

        if ($query->num_rows() > 0) {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }
    function db_table($name)
    {
        $CI = &get_instance();

        $auth_model = $CI->authentication->auth_model;

        return $CI->$auth_model->db_table($name);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('users', array('user_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {
        $current_status = $this->mcommon->specific_row_value('users', array('user_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;
        $update = $this->mcommon->common_edit('users', array('status' => $change_status), array('user_id' => $id));
        echo json_encode($id);
    }
}
