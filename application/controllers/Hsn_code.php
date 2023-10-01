<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hsn_code extends MY_Controller
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
            $data = array(
                'page_title' => 'HSN Code',
                'title' => 'HSN Code',
                'content' => $this->load->view('pages/hsn_code/hsn_code', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*');
        $this->db->from('hsn_code as u'); 
        $this->db->order_by('u.hsn_id','DESC');       
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $hsn_name = $this->input->post('hsn_name');    
            $user_id =$this->auth_user_id;            
            $insert_array = array(
                'hsn_name' => $hsn_name,               
                'created_by' => $user_id,
                'created_on' => date('Y-m-d'),
                'status' => 1,
            );
            //insert values in database
            $insert = $this->mcommon->common_insert('hsn_code', $insert_array);

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'HSN Code added successfully!');
                redirect('hsn_code');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data[] = '';
        $data = array(
            'title' => 'Add HSN Code',
            'content' => $this->load->view('pages/hsn_code/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values         
            $hsn_name = $this->input->post('hsn_name'); 
            //prepare update array
            $update_array = array(
                'hsn_name' => $hsn_name,               
            );

            //insert values in database
            $update = $this->mcommon->common_edit('hsn_code', $update_array, array('hsn_id' => $id));
            if ($update) {
                $this->session->set_flashdata('alert_success', 'HSN Code updated successfully!');
                redirect('hsn_code');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->mcommon->specific_row('hsn_code', array('hsn_id' => $id));
        $data = array(
            'title' => 'Edit HSN Code',
            'content' => $this->load->view('pages/hsn_code/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('hsn_code', array('hsn_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {       
        $current_status = $this->mcommon->specific_row_value('hsn_code', array('hsn_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;      
        $update = $this->mcommon->common_edit('hsn_code', array('status' => $change_status), array('hsn_id' => $id));
        echo json_encode($update);
    }
}