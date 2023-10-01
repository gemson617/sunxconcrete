<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
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
            $view_data['datatable'] = $this->datatable();
            $view_data['add_option'] = 1;
            $view_data['edit_option'] = 1;
            $view_data['delete_option'] = 1;
            $data = array(
                'page_title' => 'Employee Management',
                'title' => 'Employee Management',
                'content' => $this->load->view('pages/users/users', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*,b.status as status');
        $this->db->from('users as b');
        $this->db->join('role_master as r', 'r.id = b.auth_level');
        $this->db->where('auth_level!=', '9');
        $this->db->order_by('modified_at','DESC'); 
        $query = $this->db->get();
        $result = $query->result();
        //$this->datatables->add_column('action', '<a class="btn btn-primary btn-sm" href="' . base_url() . 'officers/assign_ro/edit/$1">EDIT</a> &nbsp; <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="delete_item($1)">DELETE</a>', 'id');
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            
            $email = $this->input->post('email');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $address = $this->input->post('address');
            $contact_number = $this->input->post('contact_number');            
            $role_id = $this->input->post('role_id');            
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            $pan_number = $this->input->post('pan_number');
            $aadhar_no = $this->input->post('aadhar_no');
            $dob = $this->input->post('dob');
            $doj = $this->input->post('doj');
            $bank = $this->input->post('bank');
            $account_no = $this->input->post('account_no');
            $ifsc_no = $this->input->post('ifsc_no');
            $mobile = $this->input->post('mobile');
            $created_by = $this->auth_user_id;
            $auth_level = $this->auth_level;
            if($auth_level == 9){
                $is_approve = 1;
            }else{
                $is_approve = 0;
            }
             $code_data = $this->mcommon->last_record('users','code_id','code_id');
           
            foreach($code_data as $key => $value){
                $code_id = $value['code_id']+1;
            }
            //check is the validation returns no error
            //prepare insert array                  
            $user_id = $this->get_unused_id();
            $insert_array = array(
                "user_id" => $user_id,
                "code_id" => $code_id,
                "username" => $email,
                "email" => $email,
                "mobile" => $mobile,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "address" => $address,
                "auth_level" => $role_id,
                "contact_number" => $contact_number,
                "pan_number" => $pan_number,
                "aadhar_no" => $aadhar_no,
                "dob" => $dob,
                "doj" => $doj,
                "bank" => $bank,
                "account_no" => $account_no,
                "ifsc_no" => $ifsc_no,
                "passwd" => $this->authentication->hash_passwd($password),
                "status" => $is_approve,
                "created_by" => $auth_level,
                "is_approve" => $is_approve
            );
            //insert values in database
            $insert = $this->mcommon->common_insert('users', $insert_array);
            if($auth_level == 9){
                
                $code =  $this->mcommon->specific_row_value('role_master',array('id'=>$role_id),'code');
                $emp_id = $this->mcommon->specific_row_value('users', array('user_id' => $user_id), 'code_id');
                $update_array = array(                
                    'user_code' => $code.$emp_id,
                    'approved_by' => $this->auth_user_id,
                    'approved_on' => date('Y-m-d'),                   
                    'is_approve' => 1,
                );
                //insert values in database
             $update = $this->mcommon->common_edit('users', $update_array, array('user_id' => $user_id));
            }
           
            

            if ($user_id) {
                $this->session->set_flashdata('alert_success', 'Users added successfully!');
                redirect('Users');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data['role'] = $this->mcommon->records_all('role_master',array('status'=>'1','id!='=>'9','id')); 
        $data = array(
            'title' => 'Add Employee Management',
            'content' => $this->load->view('pages/users/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
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
            $role_id = $this->input->post('role_id'); 

            $pan_number = $this->input->post('pan_number');
            $aadhar_no = $this->input->post('aadhar_no');
            $dob = $this->input->post('dob');
            $doj = $this->input->post('doj');
            $bank = $this->input->post('bank');
            $account_no = $this->input->post('account_no');
            $ifsc_no = $this->input->post('ifsc_no');
            $mobile = $this->input->post('mobile');
            $edit_remark = $this->input->post('edit_remark');

            if ($password) {
                $user_array = array(
                    "username" => $email,
                    "email" => $email,
                    "mobile" => $contact_number,               
                    "passwd" => $this->authentication->hash_passwd($password), 
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "address" => $address,  
                    // "auth_level" => $role_id,
                    "contact_number" => $contact_number,
                    "pan_number" => $pan_number,
                    "aadhar_no" => $aadhar_no,
                    "doj" => $doj,
                    "dob" => $dob,
                    "bank" => $bank,
                    "account_no" => $account_no,
                    "ifsc_no" => $ifsc_no,
                    "edit_remark" => $edit_remark,
                );
                $update_pass = $this->mcommon->common_edit('users', $user_array, array('user_id' => $id));
            //     print_r($insert_array);
            // exit();
                if ($update_pass) {
                    $this->session->set_flashdata('alert_success', 'Users updated successfully!');
                    redirect('Users');
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
                        // "auth_level" => $role_id,
                        "contact_number" => $contact_number,
                        "pan_number" => $pan_number,
                        "aadhar_no" => $aadhar_no,
                        "doj" => $doj,
                        "dob" => $dob,
                        "bank" => $bank,
                        "account_no" => $account_no,
                        "ifsc_no" => $ifsc_no,
                        "edit_remark" => $edit_remark,
                    );
                    //insert values in database
                    $update = $this->mcommon->common_edit('users', $update_array, array('user_id' => $id));      
            //         print_r($update_array);
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
        $view_data['role'] = $this->mcommon->records_all('role_master',array('status'=>'1','id!='=>'9','id'));       
        $data = array(
            'title' => 'Edit Employee Management',
            'content' => $this->load->view('pages/users/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function temp_edit($id)
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
            $role_id = $this->input->post('role_id'); 

            $pan_number = $this->input->post('pan_number');
            $aadhar_no = $this->input->post('aadhar_no');
            $dob = $this->input->post('dob');
            $doj = $this->input->post('doj');
            $bank = $this->input->post('bank');
            $account_no = $this->input->post('account_no');
            $ifsc_no = $this->input->post('ifsc_no');
            $mobile = $this->input->post('mobile');
            $edit_remark = $this->input->post('edit_remark');

            if ($password) {
                $user_array = array(
                    "temp_user_id" =>$id,
                    "temp_username" => $email,
                    "temp_email" => $email,
                    "temp_mobile" => $contact_number,               
                    "temp_passwd" => $this->authentication->hash_passwd($password), 
                    "temp_first_name" => $first_name,
                    "temp_last_name" => $last_name,
                    "temp_address" => $address,  
                    // "temp_auth_level" => $role_id,
                    "temp_contact_number" => $contact_number,
                    "temp_pan_number" => $pan_number,
                    "temp_aadhar_no" => $aadhar_no,
                    "temp_doj" => $doj,
                    "temp_dob" => $dob,
                    "temp_bank" => $bank,
                    "temp_account_no" => $account_no,
                    "temp_ifsc_no" => $ifsc_no,
                    'temp_status' => 1,
                    "edit_remark" => $edit_remark
                );
                $update_pass = $this->mcommon->common_insert('temp_users', $user_array);
                ;
           
            $edit_array =array('edit_approval'=>'1','edit_remark' => $edit_remark);
            $update_status = $this->mcommon->common_edit('users',$edit_array,array('user_id'=>$id));
            // print_r($user_array);
            // print_r($edit_array);
            //exit();
                if ($update_pass) {
                    $this->session->set_flashdata('alert_success', 'Users updated successfully!');
                    redirect('Users');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
            else{
                     //prepare update array
                    $update_array = array(
                        "temp_user_id" =>$id,
                        "temp_username" => $email,
                        "temp_email" => $email,
                        "temp_mobile" => $contact_number, 
                        "temp_first_name" => $first_name,
                        "temp_last_name" => $last_name,
                        "temp_address" => $address,
                        // "temp_auth_level" => $role_id,
                        "temp_contact_number" => $contact_number,
                        "temp_pan_number" => $pan_number,
                        "temp_aadhar_no" => $aadhar_no,
                        "temp_doj" => $doj,
                        "temp_dob" => $dob,
                        "temp_bank" => $bank,
                        "temp_account_no" => $account_no,
                        "temp_ifsc_no" => $ifsc_no,
                        'temp_status' => 1,
                        "edit_remark" => $edit_remark
                    );
                    //insert values in database
                    $update = $this->mcommon->common_insert('temp_users', $update_array);      
            //         print_r($update_array);
            // exit();    
            $edit_array =array('edit_approval'=>'1','edit_remark' => $edit_remark);
            $update_status = $this->mcommon->common_edit('users',$edit_array,array('user_id'=>$id));
                    if ($update) {
                        $this->session->set_flashdata('alert_success', 'Users updated successfully!');
                        redirect('Users');
                    } else {
                        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                    }
            }
            
        }

        $view_data['default'] = $this->mcommon->specific_row('users', array('user_id' => $id));
        $view_data['role'] = $this->mcommon->records_all('role_master',array('status'=>'1','id!='=>'9','id'));       
        $data = array(
            'title' => 'Edit Employee Management',
            'content' => $this->load->view('pages/users/edit', $view_data, true),
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
        // $update = $this->mcommon->common_edit('users', array('status' => $change_status), array('user_id' => $id));
        $auth_level =  $this->mcommon->specific_row_value('users',array('user_id'=>$id),'auth_level');
        $code =  $this->mcommon->specific_row_value('role_master',array('id'=>$auth_level),'code');
        $emp_id = $this->mcommon->specific_row_value('users', array('user_id' => $id), 'code_id');
        $update_array = array(  
            'user_code' => $code.$emp_id,
            'approved_by' => $this->auth_user_id,
            'approved_on' => date('Y-m-d'),
            'status' => $change_status,
            'is_approve' => 1,
        );
       
        //insert values in database
         $update = $this->mcommon->common_edit('users', $update_array, array('user_id' => $id));
        //  exit();
        echo json_encode($id);
    }

    public function edit_status($id)
    {
        // print_r($id);
        // exit();
        // $current_status = $this->mcommon->specific_row_value('client', array('client_id' => $id), 'edit_approval');
        // $change_status = ($current_status == 1) ? 0 : 1;
        // $current_status = $this->mcommon->specific_row_value('users', array('user_id' => $id), 'status');
       $update_data=$this->mcommon->get_temp_data('temp_users',array('temp_user_id'=>$id),'temp_user_id');
       $auth_level =  $this->mcommon->specific_row_value('users',array('user_id'=>$id),'auth_level');
       $code =  $this->mcommon->specific_row_value('role_master',array('id'=>$auth_level),'code');
       $emp_id = $this->mcommon->specific_row_value('users', array('user_id' => $id), 'code_id');
       $old_password =  $this->mcommon->specific_row_value('users',array('user_id'=>$id),'passwd');

    //    $change_status = ($current_status == 1) ? 0 : 1;
   
       $update_array = array(
             'username'=>$update_data->temp_username,
             'email'=>$update_data->temp_email,
             'first_name'=>$update_data->temp_first_name,
             'last_name'=>$update_data->temp_last_name,
             'address'=>$update_data->temp_address,
             'mobile'=>$update_data->temp_mobile,
             'passwd'=>($update_data->temp_passwd)?$update_data->temp_passwd:$old_password,
             'contact_number'=>$update_data->temp_contact_number,
             'pan_number'=>$update_data->temp_pan_number,
             'aadhar_no'=>$update_data->temp_aadhar_no,
             'dob'=>$update_data->temp_dob,
             'doj'=>$update_data->temp_doj,
             'bank'=>$update_data->temp_bank,
             'account_no'=>$update_data->temp_account_no,
             'ifsc_no'=>$update_data->temp_ifsc_no,
             'user_code' => $code.$emp_id,
            //  'status' => $change_status,
            'edit_approved_by' => $this->auth_user_id,
            'edit_approved_on' => date('Y-m-d'),
            'edit_approval' => 2,
        );

        //insert values in database
         $update = $this->mcommon->common_edit('users', $update_array, array('user_id' => $id));
         $update = $this->mcommon->common_edit('temp_users', array('temp_status'=>'0'), array('temp_user_id' => $id));
     
         //  exit();

        // $current_status = $this->mcommon->specific_row_value('client', array('client_id' => $id), 'status');
        // $change_status = ($current_status == 1) ? 0 : 1;
        // $update = $this->mcommon->common_edit('client', array('status' => $change_status), array('client_id' => $id));
        echo json_encode($update);
    }
    public function reject_status($id){
          $reject = $this->mcommon->common_edit('users',array('edit_approval'=>'3'),array('user_id'=>$id));
          $reject_temp = $this->mcommon->common_edit('temp_users',array('temp_status'=>'0'),array('temp_user_id'=>$id));
          echo json_encode($reject);
    }
    public function edit_reason($id){
        $remark = $this->mcommon->specific_row_value('users', array('user_id' => $id), 'edit_remark');        
        echo json_encode($remark);
    }
}
