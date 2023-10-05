<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plant_master extends MY_Controller
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
            $data = array(
                'page_title' => 'Plant Master',
                'title' => 'Plant Master',
                'content' => $this->load->view('pages/plant_master/plant_master', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*');
        $this->db->from('plant_master as u'); 
        $this->db->order_by('u.pm_id','DESC');       
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $plant_master_name = $this->input->post('plant_master_name');    
            $user_id =$this->auth_user_id;            
            $insert_array = array(
                'plant_master_name' => $plant_master_name,               
                'created_by' => $user_id,
                'created_on' => date('Y-m-d'),
                'status' => 1,
            );
            //insert values in database
            $insert = $this->mcommon->common_insert('plant_master', $insert_array);

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'Plant Master added successfully!');
                redirect('plant_master');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data[] = '';
        $data = array(
            'title' => 'Add Plant Master',
            'content' => $this->load->view('pages/plant_master/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values         
            $plant_master_name = $this->input->post('plant_master_name'); 
            //prepare update array
            $update_array = array(
                'plant_master_name' => $plant_master_name,               
            );

            //insert values in database
            $update = $this->mcommon->common_edit('plant_master', $update_array, array('pm_id' => $id));
            if ($update) {
                $this->session->set_flashdata('alert_success', 'Plant Master updated successfully!');
                redirect('plant_master');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->mcommon->specific_row('plant_master', array('pm_id' => $id));
        $data = array(
            'title' => 'Edit Plant Master',
            'content' => $this->load->view('pages/plant_master/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('plant_master', array('pm_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {       
        $current_status = $this->mcommon->specific_row_value('plant_master', array('pm_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;      
        $update = $this->mcommon->common_edit('plant_master', array('status' => $change_status), array('pm_id' => $id));
        echo json_encode($update);
    }
}