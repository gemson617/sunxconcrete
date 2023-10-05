<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uom extends MY_Controller
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
                'page_title' => 'Uom',
                'title' => 'Uom',
                'content' => $this->load->view('pages/uom/uom', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*');
        $this->db->from('uom as u'); 
        $this->db->order_by('u.uom_id','DESC');       
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $uom = $this->input->post('uom');    
            $user_id =$this->auth_user_id;            
            $insert_array = array(
                'uom' => $uom,               
                'created_by' => $user_id,
                'created_on' => date('Y-m-d'),
                'status' => 1,
            );
            //insert values in database
            $insert = $this->mcommon->common_insert('uom', $insert_array);

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'Uom added successfully!');
                redirect('uom');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data[] = '';
        $data = array(
            'title' => 'Add Uom',
            'content' => $this->load->view('pages/uom/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values         
            $uom = $this->input->post('uom'); 
            //prepare update array
            $update_array = array(
                'uom' => $uom,               
            );

            //insert values in database
            $update = $this->mcommon->common_edit('uom', $update_array, array('uom_id' => $id));
            if ($update) {
                $this->session->set_flashdata('alert_success', 'Uom updated successfully!');
                redirect('uom');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->mcommon->specific_row('uom', array('uom_id' => $id));
        $data = array(
            'title' => 'Edit Uom',
            'content' => $this->load->view('pages/uom/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('uom', array('uom_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {       
        $current_status = $this->mcommon->specific_row_value('uom', array('uom_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;      
        $update = $this->mcommon->common_edit('uom', array('status' => $change_status), array('uom_id' => $id));
        echo json_encode($update);
    }
}