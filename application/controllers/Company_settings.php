<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        if($this->auth_level!=9){
            redirect('/logout');
        }
    }
    public function index()
    {
        if ($this->verify_min_level(1)) {
            $view_data['datatable'] = $this->datatable();           
            $view_data['add_option'] = 1;
            $view_data['edit_option'] = 1;
            $view_data['delete_option'] = 1;            
            $data = array(
                'page_title' => 'Company Settings',
                'title' => 'Company Settings',
                'content' => $this->load->view('pages/company_settings/company_settings', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*');
        $this->db->from('em_companies as b');        
        $query = $this->db->get();
        $result = $query->result();
        //$this->datatables->add_column('action', '<a class="btn btn-primary btn-sm" href="' . base_url() . 'officers/assign_ro/edit/$1">EDIT</a> &nbsp; <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="delete_item($1)">DELETE</a>', 'id');
        return $result;
    }
  
    public function edit($id)
    {
        if (isset($_POST['submit'])) {    
        //     echo '<pre>';
        //     print_r($_POST);
        //   exit();
            //Receive Values
            $company_name = $this->input->post('company_name');			
			$company_phone_number = $this->input->post('company_phone_number');
			$company_address = $this->input->post('company_address');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$pincode = $this->input->post('pincode');
            $help_line_number = $this->input->post('help_line_number');
			$website_link = $this->input->post('website_link');
			$company_gstin = $this->input->post('company_gstin');
			$invoice_str_num = $this->input->post('invoice_str_num');
             $company_email = $this->input->post('company_email');
             $company_pan =$this->input->post('company_pan');
			$credit_note_percentage = $this->input->post('credit_note_percentage');
			$credit_note_starting_number = $this->input->post('credit_note_starting');
			$sales_starting_number = $this->input->post('sales_starting');
			$company_tan_number = $this->input->post('company_tan_number');
			$quotation_starting_number = $this->input->post('quotation_starting_number');
            // print_r($sales_starting_number);
            // exit();
            $bank_name = $this->input->post('bank_name');
            $bank_account_no = $this->input->post('bank_account_no');                
            $bank_address = $this->input->post('bank_address');                
            $bank_ifsc = $this->input->post('bank_ifsc');                
            $terms = $this->input->post('terms');                

            
            if ($_FILES['company_logo']['name']) {
                echo $_FILES['company_logo']['name'];
                if (!is_dir('./attachments/company_logo/')) {
                    mkdir('./attachments/company_logo/', 0777, true);
                }
                $upload_path = './attachments/company_logo/';
                $upload_path_table = base_url() . 'attachments/company_logo/';
                $banner = $_FILES['company_logo']['name'];
                $expbanner = explode('.', $banner);
                $bannerexptype = $expbanner[1];
                $date = date('m/d/Yh:i:sa', time());
                $rand = rand(10000, 99999);
                $encname = $date . $rand;
                $bannername = md5($encname) . '.' . $bannerexptype;
                $bannerpath = $upload_path . $bannername;
                move_uploaded_file($_FILES["company_logo"]["tmp_name"], $bannerpath);
                $attachments = $upload_path_table . $bannername;

                            //prepare update array
            $update_array = array(
                'company_name'=>$company_name,            						 
                'company_phone_number'=>$company_phone_number,
                'company_logo' => $attachments,
                'company_address'=>$company_address,
                'state'=>$state,
                'city'=>$city,
                'pincode'=>$pincode,
                'help_line_number'=>$help_line_number,
                'website_link'=>$website_link,
                'company_gstin'=>$company_gstin,
                'invoice_str_num'=>$invoice_str_num,                
                'company_tan_number'=>$company_tan_number,                
                'quotation_starting_number'=>$quotation_starting_number,                
                'company_email' => $company_email,
                'company_pan' =>$company_pan,
                'bank_name' => $bank_name,
                'credit_note_percentage' => $credit_note_percentage,
                'bank_account_no' => $bank_account_no,              
                'bank_address' => $bank_address,              
                'bank_ifsc' => $bank_ifsc,              
                'terms' => $terms,     
                'credit_note_starting_number' => $credit_note_starting_number,
                'sales_starting_number' => $sales_starting_number,         
            );
      
            //insert values in database
            $update = $this->mcommon->common_edit('em_companies', $update_array, array('id' => $id));
            if ($update) {               
                $this->session->set_flashdata('alert_success', 'Company Setting updated successfully!');
                redirect('company_settings');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
            } else {
                //prepare update array
                $update_array = array(
                    'company_name'=>$company_name,            						 
                    'company_phone_number'=>$company_phone_number,                    
                    'company_address'=>$company_address,
                    'state'=>$state,
                    'city'=>$city,
                    'pincode'=>$pincode,
                    'help_line_number'=>$help_line_number,
                    'website_link'=>$website_link,
                    'company_gstin'=>$company_gstin,
                    'invoice_str_num'=>$invoice_str_num, 
                    'company_tan_number'=>$company_tan_number,                
                    'quotation_starting_number'=>$quotation_starting_number,                
                     'company_email' => $company_email,
                     'company_pan' =>$company_pan,
                     'bank_name' => $bank_name,
                     'credit_note_percentage' => $credit_note_percentage,
                     'credit_note_starting_number' => $credit_note_starting_number,
                     'sales_starting_number' => $sales_starting_number,  
                    'bank_account_no' => $bank_account_no,              
                    'bank_address' => $bank_address,              
                    'bank_ifsc' => $bank_ifsc,              
                    'terms' => $terms,      
                );
              
               
                //insert values in database
                $update = $this->mcommon->common_edit('em_companies', $update_array, array('id' => $id));
                // print_r($update_array);
                // exit();
                
                if ($update) {               
                    $this->session->set_flashdata('alert_success', 'Company Settings updated successfully!');
                    redirect('company_settings');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
            

        }

        $view_data['default'] = $this->mcommon->specific_row('em_companies', array('id' => $id));
    
        $data = array(
            'title' => 'Edit Company Settings',
            'content' => $this->load->view('pages/company_settings/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    function db_table($name)
    {
        $CI = &get_instance();

        $auth_model = $CI->authentication->auth_model;

        return $CI->$auth_model->db_table($name);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('em_companies', array('id' => $id));
        return $delete;
    }

    public function change_status($id)
    {
        $current_status = $this->mcommon->specific_row_value('em_companies', array('id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;
        $update = $this->mcommon->common_edit('em_companies', array('status' => $change_status), array('id' => $id));
        echo json_encode($id);
    }
}
