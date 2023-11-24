<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();

        $this->load->model('authentication_model');
        if ($this->auth_level != 9) {
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
                'page_title' => 'Customer Management',
                'title' => 'Customer Management',
                'content' => $this->load->view('pages/customer/customer', $view_data, true),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*,c.status as customer_staus');
        $this->db->from('customer as c');
        $this->db->order_by('c.customer_id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        //$this->datatables->add_column('action', '<a class="btn btn-primary btn-sm" href="' . base_url() . 'officers/assign_ro/edit/$1">EDIT</a> &nbsp; <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="delete_item($1)">DELETE</a>', 'id');
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {

            $company_name = $this->input->post("company_name");
            $customer_business = $this->input->post('customer_business');
            $customer_address_1 = $this->input->post('customer_address_1');
            $customer_address_2 = $this->input->post("customer_address_2");
            $customer_city = $this->input->post('customer_city');
            $customer_state = $this->input->post('customer_state');
            $customer_pincode = $this->input->post("customer_pincode");
            $cp_name = $this->input->post("cp_name");
            $cp_contact_no = $this->input->post("cp_contact_no");
            $cp_email = $this->input->post("cp_email");
            $apoc_name = $this->input->post("apoc_name");
            $apoc_contact_no = $this->input->post("apoc_contact_no");
            $apoc_email = $this->input->post("apoc_email");
            $ppoc_name = $this->input->post("ppoc_name");
            $ppoc_contact_no = $this->input->post("ppoc_contact_no");
            $ppoc_email = $this->input->post("ppoc_email");
            $customer_pan = $this->input->post("customer_pan");
            $customer_gst_no = $this->input->post("customer_gst_no");
            $customer_cin_no = $this->input->post("customer_cin_no");
            $last_annual_turnover_cr = $this->input->post("last_annual_turnover_cr");
            $customer_tan_no = $this->input->post("customer_tan_no");
            $customer_msme_ssi = $this->input->post("customer_msme_ssi");
            $customer_aadhaar = $this->input->post("customer_aadhaar");
            $payment_terms_days = $this->input->post("payment_terms_days");
            $product_supply = $this->input->post("product_supply");
            $customer_credit_limit = $this->input->post("customer_credit_limit");

            // $dob = $this->input->post("dob");
            // $pan_number = $this->input->post("pan_number");

            $core_activity = $this->input->post("core_activity");


            //prepare insert array
            $insert_array = array(
                'customer_business' => $customer_business,
                'company_name' => $company_name,
                // 'customer_address_1' => $customer_address_1,
                // 'customer_address_2' => $customer_address_2,
                // 'customer_city' => $customer_city,
                // 'customer_state' => $customer_state,
                // 'customer_pincode' => $customer_pincode,
                'cp_name' => $cp_name,
                'cp_contact_no' => $cp_contact_no,
                'cp_email' => $cp_email,
                'apoc_name' => $apoc_name,
                'apoc_contact_no' => $apoc_contact_no,
                'apoc_email' => $apoc_email,
                'ppoc_name' => $ppoc_name,
                'ppoc_contact_no' => $ppoc_contact_no,
                'ppoc_email' => $ppoc_email,
                'customer_pan' => $customer_pan,
                'customer_gst_no' => $customer_gst_no,
                'customer_cin_no' => $customer_cin_no,
                'last_annual_turnover_cr' => $last_annual_turnover_cr,
                'customer_tan_no' => $customer_tan_no,
                'customer_msme_ssi' => $customer_msme_ssi,
                'customer_aadhaar' => $customer_aadhaar,
                'payment_terms_days' => $payment_terms_days,
                'product_supply' => $product_supply,
                'customer_credit_limit' => $customer_credit_limit,
                // 'status' => 0,
                'created_on' => date('d-m-Y'),
                'created_by' => $this->auth_user_id,
            );

            //insert values in database
            $insert = $this->mcommon->common_insert('customer', $insert_array);
            // echo $insert; exit;
            $addCount = count($customer_address_1);
            
            for ($i = 0; $i < $addCount; $i++){
                $insert_address = array(
                        'customer_id' => $insert,
                        'customer_address_1' => $customer_address_1[$i],
                        'customer_address_2' => $customer_address_2[$i],
                        'customer_city' => $customer_city[$i],
                        'customer_state' => $customer_state[$i],
                        'customer_pincode' => $customer_pincode[$i],
                        // 'created_on' => date('d-m-Y')[$i],
                        'created_by' => $this->auth_user_id,
                    );
                $insertAdress = $this->mcommon->common_insert('customer_address', $insert_address);
            }
            
            if ($insertAdress) {
                $this->session->set_flashdata('alert_success', 'Customer added successfully!');
                redirect('Customer');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data['country'] = $this->get_country();
        $view_data['state'] = $this->get_state_edit();
        $view_data['city'] = $this->get_city();

        $data = array(
            'title' => 'Add Customer Management',
            'content' => $this->load->view('pages/customer/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {

            $company_name = $this->input->post("company_name");
            $customer_business = $this->input->post('customer_business');
            $customer_address_1 = $this->input->post('customer_address_1');
            $customer_address_2 = $this->input->post("customer_address_2");
            $customer_city = $this->input->post('customer_city');
            $customer_state = $this->input->post('customer_state');
            $customer_pincode = $this->input->post("customer_pincode");
            $cp_name = $this->input->post("cp_name");
            $cp_contact_no = $this->input->post("cp_contact_no");
            $cp_email = $this->input->post("cp_email");
            $apoc_name = $this->input->post("apoc_name");
            $apoc_contact_no = $this->input->post("apoc_contact_no");
            $apoc_email = $this->input->post("apoc_email");
            $ppoc_name = $this->input->post("ppoc_name");
            $ppoc_contact_no = $this->input->post("ppoc_contact_no");
            $ppoc_email = $this->input->post("ppoc_email");
            $customer_pan = $this->input->post("customer_pan");
            $customer_gst_no = $this->input->post("customer_gst_no");
            $customer_cin_no = $this->input->post("customer_cin_no");
            $last_annual_turnover_cr = $this->input->post("last_annual_turnover_cr");
            $customer_tan_no = $this->input->post("customer_tan_no");
            $customer_msme_ssi = $this->input->post("customer_msme_ssi");
            $customer_aadhaar = $this->input->post("customer_aadhaar");
            $payment_terms_days = $this->input->post("payment_terms_days");
            $product_supply = $this->input->post("product_supply");
            $customer_credit_limit = $this->input->post("customer_credit_limit");
            // print_r($ppoc_contact_no);
            // exit();
            //check is the validation returns no error
            //prepare insert array
            $client_array = array(
                'customer_business' => $customer_business,
                'company_name' => $company_name,
                // 'customer_address_1' => $customer_address_1,
                // 'customer_address_2' => $customer_address_2,
                // 'customer_city' => $customer_city,
                // 'customer_state' => $customer_state,
                // 'customer_pincode' => $customer_pincode,
                'cp_name' => $cp_name,
                'cp_contact_no' => $cp_contact_no,
                'cp_email' => $cp_email,
                'apoc_name' => $apoc_name,
                'apoc_contact_no' => $apoc_contact_no,
                'apoc_email' => $apoc_email,
                'ppoc_name' => $ppoc_name,
                'ppoc_contact_no' => $ppoc_contact_no,
                'ppoc_email' => $ppoc_email,
                'customer_pan' => $customer_pan,
                'customer_gst_no' => $customer_gst_no,
                'customer_cin_no' => $customer_cin_no,
                'last_annual_turnover_cr' => $last_annual_turnover_cr,
                'customer_tan_no' => $customer_tan_no,
                'customer_msme_ssi' => $customer_msme_ssi,
                'customer_aadhaar' => $customer_aadhaar,
                'payment_terms_days' => $payment_terms_days,
                'product_supply' => $product_supply,
                'customer_credit_limit' => $customer_credit_limit,
                // 'status' => 1,
                'created_by' => $this->auth_user_id,
            );
            //insert values in database
            $update = $this->mcommon->common_edit('customer', $client_array, array('customer_id' => $id));
            // echo '<pre>';
            // print_r($client_array);
            // exit();
            $delete = $this->mcommon->common_delete('customer_address', array('customer_id' => $id));
            $addCount = count($customer_address_1);
            
            for ($i = 0; $i < $addCount; $i++){
                $insert_address = array(
                        'customer_id' => $id,
                        'customer_address_1' => $customer_address_1[$i],
                        'customer_address_2' => $customer_address_2[$i],
                        'customer_city' => $customer_city[$i],
                        'customer_state' => $customer_state[$i],
                        'customer_pincode' => $customer_pincode[$i],
                        // 'created_on' => date('d-m-Y')[$i],
                        'created_by' => $this->auth_user_id,
                    );
                $insertAdress = $this->mcommon->common_insert('customer_address', $insert_address);
            }

            if ($update) {
                $this->session->set_flashdata('alert_success', 'Customer updated successfully!');
                redirect('customer');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data["default"] = $this->mcommon->specific_row('customer', array('customer_id' => $id));
        $view_data["cutomerAddress"] = $this->mcommon->records_all('customer_address', array('customer_id' => $id));
        $view_data['manager'] = $this->mcommon->records_all('customer', array('status' => 1), 'company_name', "asc");
        $view_data['country'] = $this->get_country();
        $view_data['state'] = $this->get_state_edit();
        $view_data['city'] = $this->get_city();
        // echo '<pre>';
        //     print_r($view_data['cutomerAddress']);
        //     exit();
        $data = array(
            'title' => 'Edit Customer Management',
            'content' => $this->load->view('pages/customer/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function db_table($name)
    {
        $CI = &get_instance();
        $auth_model = $CI->authentication->auth_model;
        return $CI->$auth_model->db_table($name);
    }

    public function get_country()
    {
        $this->db->select("*");
        $this->db->from("countries");
        $this->db->where("flag", 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_state_edit()
    {
        $this->db->select("*");
        $this->db->from("states");
        $this->db->where("flag", 1);
        $this->db->where("country_id", 101);
        $this->db->order_by("name", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    public function get_city_edit()
    {
        $this->db->select("*");
        $this->db->from("cities");
        $this->db->where("flag", 1);
        $this->db->order_by("name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_state()
    {
        $country = $this->input->post("country_id");
        $this->db->select("*");
        $this->db->from("states");
        $this->db->where("country_id", $country);
        $this->db->where("flag", 1);
        $this->db->order_by("name", "asc");
        $query = $this->db->get();
        $result = $query->result();
        echo json_encode($result);
    }

    public function get_city()
    {
        $state = $this->input->post("state_id");
        $this->db->select("*");
        $this->db->from("cities");
        $this->db->where("state_id", $state);
        $this->db->where("flag", 1);
        $query = $this->db->get();
        $result = $query->result();
        echo json_encode($result);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('customer', array('customer_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {
        $current_status = $this->mcommon->specific_row_value('customer', array('customer_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;
        $update_array = array(
                                'status' => $change_status,
                            );
        $update = $this->mcommon->common_edit('customer', $update_array, array('customer_id' => $id));
        echo json_encode($update);
    }

}
